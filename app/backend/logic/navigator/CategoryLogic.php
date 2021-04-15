<?php
declare(strict_types=1);

namespace app\backend\logic\navigator;

use app\backend\logic\Logic;
use app\backend\model\navigator\CategoryModel as NavigatorCategoryModel;
use think\facade\Db;
use think\Paginator;
use app\core\logic\navigator\CategoryLogic as BaseNavigatorCategoryLogic;

class CategoryLogic extends BaseNavigatorCategoryLogic implements Logic
{
    private $navigatorCategoryModel;

    public function __construct()
    {
        parent::__construct();
        $this->navigatorCategoryModel = new NavigatorCategoryModel();
    }

    protected function filter($params) {
        $where = [];
        if (!empty($params['keyword'])) {
            $where[] = ['name', 'like', "%{$params['keyword']}%"];
        }
        if (!empty($params['parent_category_id'])) {
            $where[] = Db::raw("find_in_set(path, {$params['parent_category_id']})");
        }
        if (!empty($params['type'])) {
            $where[] = ['type', '=', $params['type']];
        }
        return $where;
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
        $where = $this->filter($params);
        $paginator = $this->navigatorCategoryModel->where($where)
            ->order('type', 'asc')
            ->order(Db::raw('concat(path, if(path,",",""), id)'), 'asc')
            ->order('sort', 'asc')
            ->append(['type_text', 'complete_path', 'complete_path_name'])
            ->paginate($params['limit'] ?? null);
        $this->format($paginator);
        return $paginator;
    }

    public function add($params) {
        $names = explode(PHP_EOL, $params['name']);
        $data = array_map(function($name) use ($params) {
            return [
                'type' => $params['type'],
                'name' => $name,
                'parent_id' => $params['parent_id'],
                'sort' => $params['sort'],
                'path' => $params['path'] ?? ''
            ];
        }, $names);
        return $this->navigatorCategoryModel->saveAll($data);
    }

    public function edit($id, $params) {
        $category = $this->navigatorCategoryModel->where('id', '=', $id)->find();
        if (!$category) {
            $this->setError('无效的id');
            return false;
        }
        $category->allowField(['type', 'name', 'parent_id', 'sort', 'path'])->save($params);
        return true;
    }

    public function view($id) {
        $view = $this->navigatorCategoryModel
            ->where('id', '=', $id)
            ->with(['parent'])
            ->append(['type_text', 'path_name', 'complete_path_name'])
            ->find();
        if (!$view) {
            $this->error = '无效的id';
            return false;
        }
        $view->set('parent_name', $view['parent']['name'] ?? '');
        return $view;
    }

    public function delete($id) {
        $id = explode(',', $id);
        $this->navigatorCategoryModel->whereIn('id', $id)->delete();
        return true;
    }

}
