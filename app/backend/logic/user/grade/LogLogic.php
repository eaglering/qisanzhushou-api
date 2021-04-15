<?php
declare (strict_types = 1);

namespace app\backend\logic\user\grade;

use app\backend\logic\Logic;
use app\backend\model\user\grade\LogModel as UserGradeLogModel;
use think\Paginator;
use app\core\logic\user\grade\LogLogic as BaseUserGradeLogLogic;

class LogLogic extends BaseUserGradeLogLogic implements Logic
{
    private $userGradeLogModel;

    public function __construct()
    {
        parent::__construct();
        $this->userGradeLogModel = new UserGradeLogModel();
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
        $paginator = $this->userGradeLogModel->where($where)
            ->paginate($params['limit'] ?? null);
        $this->format($paginator);
        return $paginator;
    }

    public function add($params) {
        return $this->userGradeLogModel->save($params);
    }

    public function edit($id, $params) {
        $model = $this->userGradeLogModel->where('id', '=', $id)->find();
        if (!$model) {
            $this->setError('无效的id');
            return false;
        }
        $model->save($params);
        return true;
    }

    public function view($id) {
        $model = $this->userGradeLogModel
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
        $this->userGradeLogModel->whereIn('id', $id)->delete();
        return true;
    }

}
