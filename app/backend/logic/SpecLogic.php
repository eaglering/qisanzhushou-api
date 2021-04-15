<?php
declare (strict_types = 1);

namespace app\backend\logic;

use app\backend\logic\Logic;
use app\backend\model\SpecModel as SpecModel;
use think\Paginator;
use app\core\logic\SpecLogic as BaseSpecLogic;

class SpecLogic extends BaseSpecLogic implements Logic
{
    private $specModel;

    public function __construct()
    {
        parent::__construct();
        $this->specModel = new SpecModel();
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
        $paginator = $this->specModel->where($where)
            ->paginate($params['limit'] ?? null);
        $this->format($paginator);
        return $paginator;
    }

    public function add($params) {
        return $this->specModel->save($params);
    }

    public function edit($id, $params) {
        $model = $this->specModel->where('id', '=', $id)->find();
        if (!$model) {
            $this->setError('无效的id');
            return false;
        }
        $model->save($params);
        return true;
    }

    public function view($id) {
        $model = $this->specModel
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
        $this->specModel->whereIn('id', $id)->delete();
        return true;
    }

}
