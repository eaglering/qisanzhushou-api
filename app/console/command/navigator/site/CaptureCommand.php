<?php
declare(strict_types=1);

namespace app\console\command\navigator\site;

use app\backend\model\navigator\SiteModel as NavigatorSiteModel;
use app\core\enums\navigator\site\StatusEnum;
use app\core\library\Document;
use DiDom\Query;
use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\facade\App;
use think\Facade\Db;

class CaptureCommand extends Command
{
    protected function configure()
    {
        $this->setName("navigator.site:capture");
    }

    protected function execute(Input $input, Output $output)
    {
        $navigatorSiteModel = new NavigatorSiteModel();
        Db::table($navigatorSiteModel->getTable())
            ->where('is_captured', '=', 0)
            ->order('id asc')->field(['id', 'url', 'hash_code'])
            ->chunk(100, function ($sites) use ($navigatorSiteModel) {
                /** @var NavigatorSiteModel $site */
                foreach ($sites as $site) {
                    try {
                        $uri = parse_url($site['url']);
                        $scheme = $uri['scheme'] ?? 'http';
                        $host = $uri['host'] ?? '';
                        if (!$host) {
                            $site->save(['is_captured' => 1]);
                            continue;
                        }
                        $hashCode = md5("{$scheme}://{$host}");
                        $document = new Document($site['url'], true);
                        $titles = $document->find('/html/head/title', Query::TYPE_XPATH);
                        $title = $titles ? $titles[0]->text() : '';
                        $favicons = $document->find("/html/head/link[contains(@rel, 'shortcut icon')]", Query::TYPE_XPATH);
                        if ($favicons) {
                            $favicon = $favicons[0]->attr('href');
                        } else {
                            $favicons = $document->find("/html/head/link[contains(@rel, 'icon')]", Query::TYPE_XPATH);
                            if ($favicons) {
                                $favicon = $favicons[0]->attr('href');
                            } else {
                                $favicon = "{$scheme}://{$host}/favicon.ico";
                            }
                        }
                        if (strpos($favicon, '//') === 0) {
                            $favicon = "{$scheme}:{$favicon}";
                        } else if (strpos($favicon, '/') === 0) {
                            $favicon = trim($favicon, '/');
                            $favicon = "{$scheme}://{$host}/{$favicon}";
                        }
                        $description = $document->find("/html/head/meta[contains(@name, 'description')]", Query::TYPE_XPATH);
                        $description = $description ? $description[0]->attr('content') : '';
                        if (!$description) {
                            $keyword = $document->find("/html/head/meta[contains(@name, 'keywords')]", Query::TYPE_XPATH);
                            $description = $keyword ? $keyword[0]->attr('content') : '';
                        }
                        echo $site['url'], ':', $favicon, PHP_EOL;
                        $context = stream_context_create([
                            'ssl' => [
                                'verify_peer' => false,
                                'verify_peer_name' => false
                            ]
                        ]);

                        $accessPath = '/uploads/favicon';
                        $downloadPath = App::getRootPath() . '/public' . $accessPath;
                        if (!is_dir($downloadPath)) {
                            mkdir($downloadPath, 0755, true);
                        }
                        $path = parse_url($favicon, PHP_URL_PATH);
                        $ext = pathinfo($path, PATHINFO_EXTENSION);
                        $filename = $downloadPath  . '/' . $hashCode . '.' . $ext;
                        if (!file_exists($filename)) {
                            $faviconStream = file_get_contents($favicon, false, $context);
                            if (!$faviconStream) {
                                echo '获取【', $site['url'], '】图标' . $favicon. '失败', PHP_EOL;
                                continue;
                            }
                            if (!file_put_contents($filename, $faviconStream)) {
                                echo '写入【', $site['url'], '】图标' . $favicon. '失败', PHP_EOL;
                                continue;
                            }
                        }
                        $favicon = $accessPath . '/' . $hashCode . '.' . $ext;
                        $navigatorSiteModel
                            ->where('id', '=', $site['id'])
                            ->save(['title' => $title, 'favicon' => $favicon, 'description' => $description,
                                'is_captured' => 1, 'status' => StatusEnum::ONLINE]);
                    } catch (\Exception $e) {
                        echo $e->getMessage(), ' at ', $e->getFile(), ':', $e->getLine(), PHP_EOL;
                    }
                }
            });
    }
}
