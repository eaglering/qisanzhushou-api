<?php
declare (strict_types = 1);

namespace app\backend\logic\user\points;

use app\backend\logic\Logic;
use app\backend\model\user\points\LogModel as UserPointsLogModel;
use think\Paginator;
use app\core\logic\user\points\LogLogic as BaseUserPointsLogLogic;

class LogLogic extends BaseUserPointsLogLogic implements Logic
{
    private $userPointsLogModel;

    public function __construct()
    {
        parent::__construct();
        $this->userPointsLogModel = new UserPointsLogModel();
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
        $paginator = $this->userPointsLogModel->where($where)
            ->paginate($params['limit'] ?? null);
        $this->format($paginator);
        return $paginator;
    }

    public function add($params) {
        return $this->userPointsLogModel->save($params);
    }

    public function edit($id, $params) {
        $model = $this->userPointsLogModel->where('id', '=', $id)->find();
        if (!$model) {
            $this->setError('无效的id');
            return false;
        }
        $model->save($params);
        return true;
    }

    public function view($id) {
        $model = $this->userPointsLogModel
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
        $this->userPointsLogModel->whereIn('id', $id)->delete();
        return true;
    }

}
