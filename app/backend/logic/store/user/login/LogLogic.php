<?php
declare (strict_types = 1);

namespace app\backend\logic\store\user\login;

use app\backend\logic\Logic;
use app\backend\model\store\user\login\LogModel as StoreUserLoginLogModel;
use think\Paginator;
use app\core\logic\store\user\login\LogLogic as BaseStoreUserLoginLogLogic;

class LogLogic extends BaseStoreUserLoginLogLogic implements Logic
{
    private $storeUserLoginLogModel;

    public function __construct()
    {
        parent::__construct();
        $this->storeUserLoginLogModel = new StoreUserLoginLogModel();
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
        $paginator = $this->storeUserLoginLogModel->where($where)
            ->paginate($params['limit'] ?? null);
        $this->format($paginator);
        return $paginator;
    }

    public function add($params) {
        return $this->storeUserLoginLogModel->save($params);
    }

    public function edit($id, $params) {
        $model = $this->storeUserLoginLogModel->where('id', '=', $id)->find();
        if (!$model) {
            $this->setError('无效的id');
            return false;
        }
        $model->save($params);
        return true;
    }

    public function view($id) {
        $model = $this->storeUserLoginLogModel
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
        $this->storeUserLoginLogModel->whereIn('id', $id)->delete();
        return true;
    }

}
