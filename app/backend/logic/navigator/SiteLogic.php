<?php
declare(strict_types=1);

namespace app\backend\logic\navigator;

use app\backend\logic\Logic;
use app\backend\model\navigator\CategoryModel as NavigatorCategoryModel;
use app\backend\model\navigator\SiteModel;
use app\core\enums\navigator\site\StatusEnum as SiteStatusEnum;
use app\core\enums\navigator\category\TypeEnum as CategoryTypeEnum;
use app\core\logic\navigator\SiteLogic as BaseNavigatorSiteLogic;
use think\Paginator;

class SiteLogic extends BaseNavigatorSiteLogic implements Logic
{
    private $navigatorSiteModel;
    private $navigatorCategoryModel;

    public function __construct()
    {
        parent::__construct();
        $this->navigatorSiteModel = new SiteModel();
        $this->navigatorCategoryModel = new NavigatorCategoryModel();
    }

    protected function filter($params) {
        $where = [];
        if (isset($params['keyword']) && $params['keyword'] !== '') {
            $where[] = ['title|url|description', 'like', "%{$params['keyword']}%"];
        }
        if (isset($params['type']) && $params['type'] !== '') {
            $where[] = ['type', '=', $params['type']];
        }
        if (isset($params['category_id']) && $params['category_id'] !== '') {
            $where[] = ['category_id', '=', $params['category_id']];
        }
        if (isset($params['is_hot']) && $params['is_hot'] !== '') {
            $where[] = ['is_hot', '=', $params['is_hot']];
        }
        if (isset($params['status']) && $params['status'] !== '') {
            $where[] = ['status', '=', $params['status']];
        }
        if (isset($params['is_captured']) && $params['is_captured'] !== '') {
            $where[] = ['is_captured', '=', $params['is_captured']];
        }
        return $where;
    }

    /**
     * @param Paginator $paginator
     * @return mixed
     */
    protected function format($paginator) {
        if ($paginator->isEmpty()) {
            return $paginator;
        }
        return $paginator;
    }

    public function paginator($params) {
        $where = $this->filter($params);
        $paginator = $this->navigatorSiteModel->where($where)->with(['category'])->append(['type_text'])
            ->paginate($params['limit'] ?? null);
        $this->format($paginator);
        return $paginator;
    }

    public function add($params) {
        if ($params['category_id']) {
            $category = $this->navigatorCategoryModel->where('id', '=', $params['category_id'])->find();
            $type = $category['type'];
        } else {
            $type = CategoryTypeEnum::OTHER;
        }
        $urls = explode(PHP_EOL, $params['url']);
        $errors = [];
        $data = [];
        foreach ($urls as $key => $url) {
            $index = $key + 1;
            if (filter_var($url, FILTER_VALIDATE_URL) === false) {
                $errors[] = "第{$index}行不是有效的地址";
            } else {
                $data[] = [
                    'type' => $type,
                    'url' => $url,
                    'category_id' => $params['category_id'],
                    'hash_code' => md5($url),
                    'status' => SiteStatusEnum::OFFLINE,
                    'sort' => $params['sort']
                ];
            }
        }
        if ($errors) {
            $this->setError(implode(PHP_EOL, $errors));
            return false;
        }
        return $this->navigatorSiteModel->saveAll($data);
    }

    public function edit($id, $params) {
        $site = $this->navigatorSiteModel->where('id', '=', $id)->find();
        if (!$site) {
            $this->setError('无效的id');
            return false;
        }
        if ($params['category_id']) {
            $category = $this->navigatorCategoryModel->where('id', '=', $params['category_id'])->find();
            $params['type'] = $category['type'];
        } else {
            $params['type'] = CategoryTypeEnum::OTHER;
        }
        $hashCode = md5($params['url']);
        if (!$params['is_captured'] || $hashCode !== $site['hash_code']) {
            $params['status'] = SiteStatusEnum::OFFLINE;
            $params['is_captured'] = 0;
        }
        $site->save($params);
        return true;
    }

    public function delete($id) {
        $id = explode(',', $id);
        $this->navigatorSiteModel->whereIn('id', $id)->delete();
        return true;
    }

    public function view($id) {
        $view = $this->navigatorSiteModel->where('id', '=', $id)->with(['category'])->find();
        if (!$view) {
            $this->error = '无效的id';
            return false;
        }
        $view->set('category_name', $view['category']['name'] ?? '');
        return $view;
    }

    public function state($id, $params) {
        $site = $this->navigatorSiteModel->where('id', '=', $id)->find();
        if (!$site) {
            $this->setError('无效的id');
            return false;
        }
        if (isset($params['is_captured']) && !$params['is_captured']) {
            $params['status'] = SiteStatusEnum::OFFLINE;
            $params['is_captured'] = 0;
        }
        $site->allowField(['status', 'is_captured', 'is_hot'])->save($params);
        return true;
    }
}
