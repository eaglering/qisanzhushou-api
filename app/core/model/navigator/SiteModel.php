<?php
declare(strict_types=1);

namespace app\core\model\navigator;

use app\core\enums\navigator\category\TypeEnum;
use think\Model;

class SiteModel extends Model
{
    protected $name = 'navigator_site';

    public function getTypeTextAttr($value, $data) {
        $types = TypeEnum::data();
        return $types[$data['type']]['label'] ?? '';
    }

    public function category() {
        return $this->belongsTo(CategoryModel::class, 'category_id', 'id')->append(['complete_path_name']);
    }
}
