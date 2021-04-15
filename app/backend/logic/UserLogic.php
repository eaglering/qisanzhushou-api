<?php
declare (strict_types = 1);

namespace app\backend\logic;

use app\backend\logic\Logic;
use app\backend\model\UserModel as UserModel;
use think\Paginator;
use app\core\logic\UserLogic as BaseUserLogic;

class UserLogic extends BaseUserLogic implements Logic
{
    private $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
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
        $paginator = $this->userModel->where($where)
            ->paginate($params['limit'] ?? null);
        $this->format($paginator);
        return $paginator;
    }

    public function add($params) {
        return $this->userModel->save($params);
    }

    public function edit($id, $params) {
        $model = $this->userModel->where('id', '=', $id)->find();
        if (!$model) {
            $this->setError('无效的id');
            return false;
        }
        $model->save($params);
        return true;
    }

    public function view($id) {
        $model = $this->userModel
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
        $this->userModel->whereIn('id', $id)->delete();
        return true;
    }

}
