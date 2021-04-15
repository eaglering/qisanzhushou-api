<?php
declare (strict_types = 1);

namespace app\backend\logic\goods\spec;

use app\backend\logic\Logic;
use app\backend\model\goods\spec\RelModel as GoodsSpecRelModel;
use think\Paginator;
use app\core\logic\goods\spec\RelLogic as BaseGoodsSpecRelLogic;

class RelLogic extends BaseGoodsSpecRelLogic implements Logic
{
    private $goodsSpecRelModel;

    public function __construct()
    {
        parent::__construct();
        $this->goodsSpecRelModel = new GoodsSpecRelModel();
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
        $paginator = $this->goodsSpecRelModel->where($where)
            ->paginate($params['limit'] ?? null);
        $this->format($paginator);
        return $paginator;
    }

    public function add($params) {
        return $this->goodsSpecRelModel->save($params);
    }

    public function edit($id, $params) {
        $model = $this->goodsSpecRelModel->where('id', '=', $id)->find();
        if (!$model) {
            $this->setError('无效的id');
            return false;
        }
        $model->save($params);
        return true;
    }

    public function view($id) {
        $model = $this->goodsSpecRelModel
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
        $this->goodsSpecRelModel->whereIn('id', $id)->delete();
        return true;
    }

}
