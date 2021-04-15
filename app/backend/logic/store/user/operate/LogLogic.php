<?php
declare (strict_types = 1);

namespace app\backend\logic\store\user\operate;

use app\backend\logic\Logic;
use app\backend\model\store\user\operate\LogModel as StoreUserOperateLogModel;
use think\Paginator;
use app\core\logic\store\user\operate\LogLogic as BaseStoreUserOperateLogLogic;

class LogLogic extends BaseStoreUserOperateLogLogic implements Logic
{
    private $storeUserOperateLogModel;

    public function __construct()
    {
        parent::__construct();
        $this->storeUserOperateLogModel = new StoreUserOperateLogModel();
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
        $paginator = $this->storeUserOperateLogModel->where($where)
            ->paginate($params['limit'] ?? null);
        $this->format($paginator);
        return $paginator;
    }

    public function add($params) {
        return $this->storeUserOperateLogModel->save($params);
    }

    public function edit($id, $params) {
        $model = $this->storeUserOperateLogModel->where('id', '=', $id)->find();
        if (!$model) {
            $this->setError('无效的id');
            return false;
        }
        $model->save($params);
        return true;
    }

    public function view($id) {
        $model = $this->storeUserOperateLogModel
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
        $this->storeUserOperateLogModel->whereIn('id', $id)->delete();
        return true;
    }

}
