<?php
declare (strict_types=1);

namespace app\core\model;

use app\core\enums\coupon\ApplyRangeEnum;
use app\core\enums\coupon\CouponTypeEnum;
use think\Model;
use app\core\model\coupon\GoodsModel as CouponGoodsModel;

/**
 * @mixin \think\Model
 */
class CouponModel extends Model
{
    protected $name = 'coupon';

    public function getCouponTypeTextAttr($value, $data)
    {
        $map = CouponTypeEnum::data();
        return $map[$data['coupon_type']]['label'];
    }

    public function getApplyRangeAttr($value, $data)
    {
        $map = ApplyRangeEnum::data();
        return $map[$data['apply_range']]['label'];
    }

    public function goods()
    {
        return $this->hasMany(CouponGoodsModel::class, 'coupon_id');
    }
}
