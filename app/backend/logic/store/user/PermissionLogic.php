<?php
declare(strict_types=1);

namespace app\backend\logic\store\user;

use app\core\model\store\UserModel as StoreUserModel;
use app\backend\model\store\user\PermissionModel as StoreUserPermissionModel;
use app\core\enums\store\user\permission\TypeEnum as StoreUserPermissionTypeEnum;
use app\backend\model\store\role\PermissionModel as StoreRolePermissionModel;
use app\backend\model\store\PermissionModel as StorePermissionModel;
use app\backend\model\store\RoleModel as StoreRoleModel;
use think\facade\Cache;
use app\core\logic\store\user\PermissionLogic as BaseStoreUserPermissionLogic;

class PermissionLogic extends BaseStoreUserPermissionLogic
{
    /**
     * 检测是否有权限
     * @param StoreUserModel $identifier
     * @param string $url
     * @param bool $strict 批量验证下是否需要全部验证通过
     * @return bool
     */
    public function checkPrivilege($identifier, $url, $strict = true)
    {
        if (!is_array($url)) {
            return $this->checkAccess($identifier, $url);
        }
        foreach ($url as $val) {
            if ($strict && !$this->checkAccess($identifier, $val)) {
                return false;
            }
            if (!$strict && $this->checkAccess($identifier, $val)) {
                return true;
            }
        }
        return false;
    }

    /**
     * 检测权限
     * @param StoreUserModel $identifier
     * @param string $url
     * @param array $allowAction
     * @return bool
     */
    public function checkAccess($identifier, $url, $allowAction = [])
    {
        if ($identifier->isEmpty() || empty($identifier['id'])) {
            return false;
        }
        if (!empty($identifier['is_super'])) {
            return true;
        }
        // 验证当前请求是否在白名单
        if ($allowAction && in_array($url, $allowAction)) {
            return true;
        }
        // 通配符支持
        foreach ($allowAction as $action) {
            if (strpos($action, '*') !== false
                && preg_match('/^' . str_replace('/', '\/', $action) . '/', $url)
            ) {
                return true;
            }
        }
        // 获取当前用户的权限url列表
        $permissions = $this->getPermissions($identifier['id']);
        if ($permissions['permissions']) {
            $permission = collect($permissions['permissions'])->filter(function ($item) use ($url) {
                return $item['url'] === $url;
            });
            return !$permission->isEmpty();
        }
        return false;
    }

    /**
     * 获取用户权限与角色列表
     * @param $userId
     * @return \think\Collection
     */
    public function getPermissions($userId) {
        $key = "__store_user_permission__{$userId}";
        $permissions = Cache::get($key);
        if (!$permissions) {
            $userPermissionModel = new StoreUserPermissionModel;
            $userPermissions = $userPermissionModel->where('user_id', '=', $userId)->select();
            $roleIds = [];
            $permissionIds = [];
            foreach ($userPermissions as $item) {
                if ($item['type'] == StoreUserPermissionTypeEnum::ROLE) {
                    $roleIds[] = $item['rule_id'];
                } else if ($item['type'] == StoreUserPermissionTypeEnum::PERMISSION) {
                    $permissionIds[] = $item['rule_id'];
                }
            }
            $storeRoleModel = new StoreRoleModel;
            $roles = $storeRoleModel->whereIn('id', $roleIds)->select();
            $storeRolePermissionModel = new StoreRolePermissionModel;
            $rolePermissionIds = $storeRolePermissionModel->whereIn('role_id', $roleIds)->column('permission_id');
            $permissionIds = array_unique(array_merge($permissionIds, $rolePermissionIds));
            $storePermissionModel = new StorePermissionModel;
            $permissions = $storePermissionModel->whereIn('id', $permissionIds)->select();
            Cache::set($key, compact('permissions', 'roles'), 7200);
        }
        return $permissions;
    }
}
