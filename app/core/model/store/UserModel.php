<?php
declare (strict_types = 1);

namespace app\core\model\store;

use think\Model;
use app\core\model\store\user\PermissionModel as StoreUserPermissionModel;

/**
 * @mixin \think\Model
 */
class UserModel extends Model
{
    protected $name = 'store_user';

    public function rules() {
        return $this->hasMany(StoreUserPermissionModel::class, 'user_id');
    }
}
