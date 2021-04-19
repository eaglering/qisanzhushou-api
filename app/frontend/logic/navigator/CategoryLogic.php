<?php

namespace app\frontend\logic\navigator;

use app\core\enums\navigator\category\TypeEnum;
use app\core\enums\navigator\site\StatusEnum;
use app\core\model\navigator\CategoryModel;
use think\db\Query;

class CategoryLogic
{
    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    /**
     * 获取首页快速搜索
     * @return array
     */
    public function getHomeQuickSearch() {
        return $this->getSecondCategory(TypeEnum::HOME_QUICK_SEARCH);
    }

    /**
     * 获取首页综合
     * @return array
     */
    public function getHomeComprehensive() {
        return $this->getCategory(TypeEnum::HOME_COMPREHENSIVE);
    }

    /**
     * 获取工具
     * @return array
     */
    public function getToolQuickSearch() {
        return $this->getCategory(TypeEnum::TOOL);
    }

    /**
     * 获取项目推荐
     * @return array
     */
    public function getProjectQuickSearch() {
        return $this->getCategory(TypeEnum::PROJECT);
    }

    public function getCategory($type) {
        return $this->categoryModel->where('type', '=', $type)
            ->order('parent_id', 'asc')
            ->order('sort', 'asc')
            ->with(['sites' => function($query) {
                /** @var Query $query */
                $query->where('status', '=', StatusEnum::ONLINE);
            }])
            ->select()->toArray();
    }

    public function getSecondCategory($type) {
        $data = $this->getCategory($type);
        $result = [];
        foreach ($data as $category) {
            $cid = $category['id'];
            if (!$category['parent_id']) {
                $category['children'] = [];
                $result[$cid] = $category;
            } else if (isset($result[$category['parent_id']]) && $category['sites']) {
                $result[$category['parent_id']]['children'][] = $category;
            }
        }
        $result = array_filter($result, function ($item) {
            return $item['children'];
        });
        return array_values($result);
    }
}
