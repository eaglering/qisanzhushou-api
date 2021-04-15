<?php
declare (strict_types = 1);

namespace app\backend\logic\order;

use app\backend\logic\Logic;
use app\backend\model\order\RefundModel as OrderRefundModel;
use think\Paginator;
use app\core\logic\order\RefundLogic as BaseOrderRefundLogic;

class RefundLogic extends BaseOrderRefundLogic implements Logic
{
    private $orderRefundModel;

    public function __construct()
    {
        parent::__construct();
        $this->orderRefundModel = new OrderRefundModel();
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
        $paginator = $this->orderRefundModel->where($where)
            ->paginate($params['limit'] ?? null);
        $this->format($paginator);
        return $paginator;
    }

    public function add($params) {
        return $this->orderRefundModel->save($params);
    }

    public function edit($id, $params) {
        $model = $this->orderRefundModel->where('id', '=', $id)->find();
        if (!$model) {
            $this->setError('无效的id');
            return false;
        }
        $model->save($params);
        return true;
    }

    public function view($id) {
        $model = $this->orderRefundModel
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
        $this->orderRefundModel->whereIn('id', $id)->delete();
        return true;
    }

}
