<?php
declare (strict_types = 1);

namespace app\backend\logic\coupon;

use app\backend\logic\Logic;
use app\backend\model\coupon\GoodsModel as CouponGoodsModel;
use think\Paginator;
use app\core\logic\coupon\GoodsLogic as BaseCouponGoodsLogic;

class GoodsLogic extends BaseCouponGoodsLogic implements Logic
{
    private $couponGoodsModel;

    public function __construct()
    {
        parent::__construct();
        $this->couponGoodsModel = new CouponGoodsModel();
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
        $paginator = $this->couponGoodsModel->where($where)
            ->paginate($params['limit'] ?? null);
        $this->format($paginator);
        return $paginator;
    }

    public function add($params) {
        return $this->couponGoodsModel->save($params);
    }

    public function edit($id, $params) {
        $model = $this->couponGoodsModel->where('id', '=', $id)->find();
        if (!$model) {
            $this->setError('无效的id');
            return false;
        }
        $model->save($params);
        return true;
    }

    public function view($id) {
        $model = $this->couponGoodsModel
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
        $this->couponGoodsModel->whereIn('id', $id)->delete();
        return true;
    }

}
