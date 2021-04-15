<?php
declare (strict_types = 1);

namespace app\backend\logic\store;

use app\backend\logic\Logic;
use app\backend\model\store\SettingModel as StoreSettingModel;
use app\core\enums\store\settings\KeyEnum;
use think\facade\Cache;
use think\Paginator;
use app\core\logic\store\SettingLogic as BaseStoreSettingLogic;

class SettingLogic extends BaseStoreSettingLogic
{
    private $storeSettingModel;

    public function __construct()
    {
        parent::__construct();
        $this->storeSettingModel = new StoreSettingModel();
    }

    public function edit($key, $params) {
        $model = $this->storeSettingModel->where('key', '=', $key)->find();
        if (!$model) $model = $this->storeSettingModel;
        $map = KeyEnum::data();
        if ($model->save([
            'key' => $key,
            'describe' => $map[$key]['label'],
            'values' => $params
        ])) {
            Cache::delete('store_setting');
        }
        return true;
    }

    public function cache() {
        $list = ['store_setting'];
    }
}
