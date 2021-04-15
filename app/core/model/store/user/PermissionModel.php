<?php
declare (strict_types = 1);

namespace app\core\model\store\user;

use think\Model;
use app\core\model\store\UserModel as StoreUserModel;

/**
 * @mixin \think\Model
 */
class PermissionModel extends Model
{
    protected $name = 'store_user_permission';

    /**
     * 用户
     * @return \think\model\relation\BelongsTo
     */
    public function user() {
        return $this->belongsTo(StoreUserModel::class, 'user_id');
    }
}
