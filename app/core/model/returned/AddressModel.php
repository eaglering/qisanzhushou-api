<?php
declare (strict_types = 1);

namespace app\core\model\returned;

use think\Model;

/**
 * @mixin \think\Model
 */
class AddressModel extends Model
{
    protected $name = 'returned_address';
}
