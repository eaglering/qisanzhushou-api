<?php
declare (strict_types = 1);

namespace app\core\model\goods\spec;

use think\model\Pivot;

/**
 * @mixin \think\Model
 */
class RelModel extends Pivot
{
    protected $name = 'goods_spec_rel';
}
