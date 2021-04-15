<?php
declare (strict_types = 1);

namespace app\core\model\store;

use app\core\model\navigator\CategoryModel;
use app\core\model\navigator\SiteModel;
use think\Model;

/**
 * @mixin \think\Model
 */
class PermissionModel extends Model
{
    protected $name = 'store_permission';

    public function getPathNameAttr($value, $data) {
        $paths = [];
        if ($data['path']) {
            $paths = explode(',', $data['path']);
            $categories = $this->whereIn('id', $paths)->column('name', 'id');
            $paths = array_map(function ($id) use ($categories) {
                return $categories[$id] ?? $id;
            }, $paths);
        }
        return $paths ? join('>', $paths) : '顶级权限';
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
        return $this->belongsTo(CategoryModel::class, 'parent_id', 'id');
    }
}
