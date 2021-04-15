<?php
declare (strict_types = 1);

namespace app\core\model\order\refund;

use think\Model;

/**
 * @mixin \think\Model
 */
class AddressModel extends Model
{
    protected $name = 'order_refund_address';
}
