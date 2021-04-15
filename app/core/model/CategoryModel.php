<?php
declare (strict_types = 1);

namespace app\core\model;

use think\Model;
use app\core\model\upload\FileModel as UploadFileModel;

/**
 * @mixin \think\Model
 */
class CategoryModel extends Model
{
    protected $name = 'category';

    public function getPathNameAttr($value, $data) {
        $paths = [];
        if ($data['path']) {
            $paths = explode(',', $data['path']);
            $categories = $this->whereIn('id', $paths)->column('name', 'id');
            $paths = array_map(function ($id) use ($categories) {
                return $categories[$id] ?? $id;
            }, $paths);
        }
        return $paths ? join('>', $paths) : '顶级分类';
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

    public function file() {
        return $this->belongsTo(UploadFileModel::class, 'image_id');
    }

    public function parent() {
        return $this->belongsTo(CategoryModel::class, 'parent_id');
    }
}
