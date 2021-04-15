<?php
declare(strict_types=1);

namespace app\core\model\navigator;

use app\core\enums\navigator\category\TypeEnum;
use think\Model;

class CategoryModel extends Model
{
    protected $name = 'navigator_category';

    public function getTypeTextAttr($value, $data) {
        $types = TypeEnum::data();
        return $types[$data['type']]['label'] ?? '';
    }

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

    public function sites() {
        return $this->hasMany(SiteModel::class, 'category_id', 'id');
    }

    public function parent() {
        return $this->belongsTo(CategoryModel::class, 'parent_id', 'id');
    }
}
