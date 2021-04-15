<?php
declare (strict_types = 1);

namespace app\backend\logic;

use app\backend\model\CategoryModel as CategoryModel;
use app\core\enums\category\TypeEnum;
use think\db\concern\WhereQuery;
use think\facade\Db;
use think\Paginator;
use app\core\logic\CategoryLogic as BaseCategoryLogic;

class CategoryLogic extends BaseCategoryLogic implements Logic
{
    private $categoryModel;

    public function __construct()
    {
        parent::__construct();
        $this->categoryModel = new CategoryModel();
    }

    /**
     * @param WhereQuery $q
     * @param $params
     */
    protected function filter($q, $params) {
        if (filterable_string($params, 'keyword')) {
            $q->whereLike('name', '%' . $params['keyword'] . '%');
        }
    }

    /**
     * @param Paginator $paginator
     * @return mixed
     */
    protected function format($paginator) {
        if ($paginator->isEmpty()) {
            return $paginator;
        }
        return $paginator;
    }

    public function paginator($params) {
        $paginator = $this->categoryModel->where(function ($query) use ($params) { $this->filter($query, $params); })
            ->where('is_delete', '=', 0)
            ->order(Db::raw('concat(path, if(path,",",""), id)'), 'asc')
            ->order('sort', 'asc')
            ->with(['file'])
            ->append(['complete_path', 'complete_path_name'])
            ->paginate($params['limit'] ?? null);
        $this->format($paginator);
        return $paginator;
    }

    public function add($params) {
        $names = explode(PHP_EOL, $params['name']);
        $data = array_map(function($name) use ($params) {
            return [
                'type' => TypeEnum::MATERIAL_OBJECT,
                'name' => $name,
                'image_id' => $params['image_id'],
                'parent_id' => $params['parent_id'],
                'sort' => $params['sort'],
                'path' => $params['path'] ?? ''
            ];
        }, $names);
        return $this->categoryModel->saveAll($data);
    }

    public function edit($id, $params) {
        $model = $this->categoryModel->where('id', '=', $id)->find();
        if (!$model) {
            $this->setError('无效的id');
            return false;
        }
        $model->allowField(['name', 'image_id', 'parent_id', 'sort', 'path'])->save($params);
        return true;
    }

    public function view($id) {
        $model = $this->categoryModel
            ->where('id', '=', $id)
            ->where('is_delete', '=', 0)
            ->with(['parent', 'file'])
            ->append(['path_name', 'complete_path_name'])
            ->find();
        if (!$model) {
            $this->error = '无效的id';
            return false;
        }
        return $model;
    }

    public function delete($id) {
        $id = explode(',', $id);
        $this->categoryModel->whereIn('id', $id)->useSoftDelete('is_delete', 1)->delete();
        return true;
    }

}
