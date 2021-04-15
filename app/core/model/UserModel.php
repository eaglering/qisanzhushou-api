<?php
declare (strict_types = 1);

namespace app\core\model;

use think\Model;

/**
 * @mixin \think\Model
 */
class UserModel extends Model
{
    protected $name = 'user';
}
