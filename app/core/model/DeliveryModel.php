<?php
declare (strict_types=1);

namespace app\core\model;

use app\core\enums\delivery\MethodEnum;
use think\Model;
use app\core\model\delivery\RuleModel as DeliveryRuleModel;
use app\core\model\GoodsModel;

/**
 * @mixin \think\Model
 */
class DeliveryModel extends Model
{
    protected $name = 'delivery';

    public function getMethodTextAttr($value, $data)
    {
        $map = MethodEnum::data();
        return $map[$data['method']]['label'] ?? '';
    }

    public function goods() {
        return $this->hasMany(GoodsModel::class, 'delivery_id');
    }

    /**
     * 配置规则
     * @return \think\model\relation\HasMany
     */
    public function rules()
    {
        return $this->hasMany(DeliveryRuleModel::class, 'delivery_id');
    }
}
