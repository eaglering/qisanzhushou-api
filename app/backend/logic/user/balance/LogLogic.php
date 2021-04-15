<?php
declare (strict_types = 1);

namespace app\backend\logic\user\balance;

use app\backend\logic\Logic;
use app\backend\model\user\balance\LogModel as UserBalanceLogModel;
use think\Paginator;
use app\core\logic\user\balance\LogLogic as BaseUserBalanceLogLogic;

class LogLogic extends BaseUserBalanceLogLogic implements Logic
{
    private $userBalanceLogModel;

    public function __construct()
    {
        parent::__construct();
        $this->userBalanceLogModel = new UserBalanceLogModel();
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
        $paginator = $this->userBalanceLogModel->where($where)
            ->paginate($params['limit'] ?? null);
        $this->format($paginator);
        return $paginator;
    }

    public function add($params) {
        return $this->userBalanceLogModel->save($params);
    }

    public function edit($id, $params) {
        $model = $this->userBalanceLogModel->where('id', '=', $id)->find();
        if (!$model) {
            $this->setError('无效的id');
            return false;
        }
        $model->save($params);
        return true;
    }

    public function view($id) {
        $model = $this->userBalanceLogModel
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
        $this->userBalanceLogModel->whereIn('id', $id)->delete();
        return true;
    }

}
