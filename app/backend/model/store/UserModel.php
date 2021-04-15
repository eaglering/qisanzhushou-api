<?php
declare (strict_types = 1);

namespace app\backend\model\store;

use app\core\model\store\UserModel as BaseStoreUserModel;
use think\db\concern\WhereQuery;
use think\facade\Request;

class UserModel extends BaseStoreUserModel
{
    protected $hidden = ['password'];
    protected $globalScope = [
        'super'
    ];

    /**
     * @param WhereQuery $query
     */
    public function scopeSuper($query) {
        $identifier = Request::middleware('identifier');
        if ($identifier instanceof BaseStoreUserModel && !$identifier['is_super']) {
            $query->where('is_super', '=', 0);
        }
    }
}
