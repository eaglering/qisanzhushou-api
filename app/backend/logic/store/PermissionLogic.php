<?php
declare (strict_types = 1);

namespace app\backend\logic\store;

use app\backend\logic\Logic;
use app\backend\model\store\PermissionModel as StorePermissionModel;
use app\backend\model\store\user\PermissionModel as StoreUserPermissionModel;
use app\backend\model\store\role\PermissionModel as StoreRolePermissionModel;
use app\core\enums\store\user\permission\TypeEnum;
use think\facade\Db;
use think\Paginator;
use app\core\logic\store\PermissionLogic as BaseStorePermissionLogic;

class PermissionLogic extends BaseStorePermissionLogic implements Logic
{
    private $storePermissionModel;

    public function __construct()
    {
        parent::__construct();
        $this->storePermissionModel = new StorePermissionModel();
    }

    protected function filter($params) {
        $where = [];
        if (filterable_string($params, 'keyword')) {
            $where[] = ['name', 'like', '%' . $params['keyword'] . '%'];
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
        $paginator = $this->storePermissionModel->where($where)
            ->order(Db::raw('concat(path, if(path,",",""), id)'), 'asc')
            ->order('sort', 'asc')
            ->append(['path_name', 'complete_path', 'complete_path_name'])
            ->paginate($params['limit'] ?? null);
        $this->format($paginator);
        return $paginator;
    }

    public function add($params) {
        $lines = explode(PHP_EOL, $params['name']);
        $data = array_map(function($line) use ($params) {
            $args = explode(' ', $line);
            $name = array_shift($args);
            $url = array_shift($args);
            $url = $url ?: null;
            return [
                'name' => $name,
                'url' => $url ,
                'parent_id' => $params['parent_id'],
                'sort' => $params['sort'],
                'path' => $params['path'] ?? ''
            ];
        }, $lines);
        return $this->storePermissionModel->saveAll($data);
    }

    public function edit($id, $params) {
        $model = $this->storePermissionModel->where('id', '=', $id)->find();
        if (!$model) {
            $this->setError('无效的id');
            return false;
        }
        $model->save($params);
        return true;
    }

    public function view($id) {
        $model = $this->storePermissionModel
            ->where('id', '=', $id)
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
        $children = $this->storePermissionModel->whereIn('parent_id', $id)->exists();
        if ($children) {
            $this->error = '权限存在子集不可删除';
            return false;
        }
        $storeUserPermissionModel = new StoreUserPermissionModel;
        $rules = $storeUserPermissionModel->where('type', '=', TypeEnum::PERMISSION)
            ->whereIn('rule_id', $id)->exists();
        if ($rules) {
            $this->error = '权限已被分配给用户不可删除';
            return false;
        }
        $storeRolePermissionModel = new StoreRolePermissionModel;
        $roles = $storeRolePermissionModel->whereIn('permission_id', $id)->exists();
        if ($roles) {
            $this->error = '权限已被分配给角色不可删除';
            return false;
        }
        $this->storePermissionModel->whereIn('id', $id)->delete();
        return true;
    }

    public function tree() {
        $all = $this->storePermissionModel->order('sort', 'asc')->column(['id', 'name', 'url', 'parent_id']);
        return list2tree($all, 'id', 'parent_id');
    }
}
