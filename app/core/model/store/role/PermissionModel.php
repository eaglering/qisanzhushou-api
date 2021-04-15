<?php
declare (strict_types = 1);

namespace app\core\model\store\role;

use think\Model;

/**
 * @mixin \think\Model
 */
class PermissionModel extends Model
{
    protected $name = 'store_role_permission';
}
