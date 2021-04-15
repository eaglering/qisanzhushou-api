<?php
declare (strict_types = 1);

namespace app\core\model\store;

use think\db\concern\WhereQuery;
use think\facade\Request;
use think\Model;
use app\core\model\store\role\PermissionModel as StoreRolePermissionModel;

/**
 * @mixin \think\Model
 */
class RoleModel extends Model
{
    protected $name = 'store_role';

    public function getPathNameAttr($value, $data) {
        $paths = [];
        if ($data['path']) {
            $paths = explode(',', $data['path']);
            $categories = $this->whereIn('id', $paths)->column('name', 'id');
            $paths = array_map(function ($id) use ($categories) {
                return $categories[$id] ?? $id;
            }, $paths);
        }
        return $paths ? join('>', $paths) : '顶级角色';
    }

    public function getCompletePathAttr($value, $data) {
        if ($data['path']) {
            return $data['path'] . ',' . $data['id'];
        } else {
            return "{$data['id']}";
        }
    }

    public function getCompletePathNameAttr($value, $data) {
        $paths = [];
        if ($data['path']) {
            $paths = explode(',', $data['path']);
            $categories = $this->whereIn('id', $paths)->column('name', 'id');
            $paths = array_map(function ($id) use ($categories) {
                return $categories[$id] ?? $id;
            }, $paths);
        }
        $paths[] = $data['name'];
        return join('>', $paths);
    }

    public function parent() {
        return $this->belongsTo(RoleModel::class, 'parent_id');
    }

    /**
     * 角色权限
     * @return \think\model\relation\HasMany
     */
    public function permissions() {
        return $this->hasMany(StoreRolePermissionModel::class, 'role_id');
    }
}
