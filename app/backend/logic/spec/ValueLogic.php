<?php
declare (strict_types = 1);

namespace app\backend\logic\spec;

use app\backend\logic\Logic;
use app\backend\model\spec\ValueModel as SpecValueModel;
use think\Paginator;
use app\core\logic\spec\ValueLogic as BaseSpecValueLogic;

class ValueLogic extends BaseSpecValueLogic implements Logic
{
    private $specValueModel;

    public function __construct()
    {
        parent::__construct();
        $this->specValueModel = new SpecValueModel();
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
        $paginator = $this->specValueModel->where($where)
            ->paginate($params['limit'] ?? null);
        $this->format($paginator);
        return $paginator;
    }

    public function add($params) {
        return $this->specValueModel->save($params);
    }

    public function edit($id, $params) {
        $model = $this->specValueModel->where('id', '=', $id)->find();
        if (!$model) {
            $this->setError('无效的id');
            return false;
        }
        $model->save($params);
        return true;
    }

    public function view($id) {
        $model = $this->specValueModel
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
        $this->specValueModel->whereIn('id', $id)->delete();
        return true;
    }

}
