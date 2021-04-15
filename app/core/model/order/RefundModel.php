<?php
declare (strict_types = 1);

namespace app\core\model\order;

use think\Model;

/**
 * @mixin \think\Model
 */
class RefundModel extends Model
{
    protected $name = 'order_refund';
}
