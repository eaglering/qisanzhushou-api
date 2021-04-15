<?php
declare (strict_types = 1);

namespace app\backend\model;

use app\core\enums\category\TypeEnum;
use app\core\model\CategoryModel as BaseCategoryModel;
use think\db\concern\WhereQuery;

class CategoryModel extends BaseCategoryModel
{
    protected $globalScope = ['type'];

    /**
     * @param WhereQuery $query
     */
    public function scopeType($query)
    {
        $query->where('type', '=', TypeEnum::MATERIAL_OBJECT);
    }
}
