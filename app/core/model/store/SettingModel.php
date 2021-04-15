<?php
declare (strict_types = 1);

namespace app\core\model\store;

use think\Model;

/**
 * @mixin \think\Model
 */
class SettingModel extends Model
{
    protected $name = 'store_setting';

    /**
     * 获取器: 转义数组格式
     * @param $value
     * @return mixed
     */
    public function getValuesAttr($value)
    {
        return json_decode($value, true);
    }

    /**
     * 修改器: 转义成json格式
     * @param $value
     * @return string
     */
    public function setValuesAttr($value)
    {
        return json_encode($value);
    }
}
