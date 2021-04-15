<?php
declare (strict_types = 1);

namespace app\backend\logic\store\role;

use app\backend\logic\Logic;
use app\backend\model\store\role\PermissionModel as StoreRolePermissionModel;
use think\Paginator;
use app\core\logic\store\role\PermissionLogic as BaseStoreRolePermissionLogic;

class PermissionLogic extends BaseStoreRolePermissionLogic implements Logic
{
    private $storeRolePermissionModel;

    public function __construct()
    {
        parent::__construct();
        $this->storeRolePermissionModel = new StoreRolePermissionModel();
    }

    protected function filter($params) {
        $where = [];
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
        $paginator = $this->storeRolePermissionModel->where($where)
            ->paginate($params['limit'] ?? null);
        $this->format($paginator);
        return $paginator;
    }

    public function add($params) {
        return $this->storeRolePermissionModel->save($params);
    }

    public function edit($id, $params) {
        $model = $this->storeRolePermissionModel->where('id', '=', $id)->find();
        if (!$model) {
            $this->setError('无效的id');
            return false;
        }
        $model->save($params);
        return true;
    }

    public function view($id) {
        $model = $this->storeRolePermissionModel
            ->where('id', '=', $id)
            ->find();
        if (!$model) {
            $this->error = '无效的id';
            return false;
        }
        return $model;
    }

    public function delete($id) {
        $id = explode(',', $id);
        $this->storeRolePermissionModel->whereIn('id', $id)->delete();
        return true;
    }

}
