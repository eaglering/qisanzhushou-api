<?php
declare (strict_types = 1);

namespace app\backend\logic\order\refund;

use app\backend\logic\Logic;
use app\backend\model\order\refund\AddressModel as OrderRefundAddressModel;
use think\Paginator;
use app\core\logic\order\refund\AddressLogic as BaseOrderRefundAddressLogic;

class AddressLogic extends BaseOrderRefundAddressLogic implements Logic
{
    private $orderRefundAddressModel;

    public function __construct()
    {
        parent::__construct();
        $this->orderRefundAddressModel = new OrderRefundAddressModel();
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
        $paginator = $this->orderRefundAddressModel->where($where)
            ->paginate($params['limit'] ?? null);
        $this->format($paginator);
        return $paginator;
    }

    public function add($params) {
        return $this->orderRefundAddressModel->save($params);
    }

    public function edit($id, $params) {
        $model = $this->orderRefundAddressModel->where('id', '=', $id)->find();
        if (!$model) {
            $this->setError('无效的id');
            return false;
        }
        $model->save($params);
        return true;
    }

    public function view($id) {
        $model = $this->orderRefundAddressModel
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
        $this->orderRefundAddressModel->whereIn('id', $id)->delete();
        return true;
    }

}
