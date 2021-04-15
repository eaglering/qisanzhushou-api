<?php
declare (strict_types = 1);

namespace app\core\model\delivery;

use think\Model;

/**
 * @mixin \think\Model
 */
class RuleModel extends Model
{
    protected $name = 'delivery_rule';

    protected $append = [
        'first_fee',
        'additional_fee'
    ];

    public function getFirstFeeAttr($value, $data) {
        return fen2yuan($data['first_fee_fen']);
    }

    public function getAdditionalFeeAttr($value, $data) {
        return fen2yuan($data['additional_fee_fen']);
    }
}
