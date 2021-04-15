<?php
declare (strict_types = 1);

namespace app\core\model\upload;

use app\backend\logic\store\SettingLogic as StoreSettingLogic;
use app\core\driver\storage\Driver;
use app\core\enums\store\settings\KeyEnum;
use think\Model;

/**
 * @mixin \think\Model
 */
class FileModel extends Model
{
    protected $name = 'upload_file';
    protected $append = ['file_url'];

    public function getFileUrlAttr($value, $data) {
        $app = app();
        $key = 'storage.' . $data['storage'];
        if (!isset($app[$key])) {
            $settingLogic = new StoreSettingLogic;
            $config = $settingLogic->getItem(KeyEnum::STORAGE);
            $config['default_engine'] = $data['storage'];
            $driver = new Driver($config);
            $app[$key] = $driver;
        } else {
            $driver = $app[$key];
        }
        return $driver->getFileUrl($data['file_object']);
    }
}
