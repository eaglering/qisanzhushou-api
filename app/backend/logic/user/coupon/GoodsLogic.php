<?php
declare (strict_types = 1);

namespace app\backend\logic\user\coupon;

use app\backend\logic\Logic;
use app\backend\model\user\coupon\GoodsModel as UserCouponGoodsModel;
use think\Paginator;
use app\core\logic\user\coupon\GoodsLogic as BaseUserCouponGoodsLogic;

class GoodsLogic extends BaseUserCouponGoodsLogic implements Logic
{
    private $userCouponGoodsModel;

    public function __construct()
    {
        parent::__construct();
        $this->userCouponGoodsModel = new UserCouponGoodsModel();
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
        $paginator = $this->userCouponGoodsModel->where($where)
            ->paginate($params['limit'] ?? null);
        $this->format($paginator);
        return $paginator;
    }

    public function add($params) {
        return $this->userCouponGoodsModel->save($params);
    }

    public function edit($id, $params) {
        $model = $this->userCouponGoodsModel->where('id', '=', $id)->find();
        if (!$model) {
            $this->setError('无效的id');
            return false;
        }
        $model->save($params);
        return true;
    }

    public function view($id) {
        $model = $this->userCouponGoodsModel
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
        $this->userCouponGoodsModel->whereIn('id', $id)->delete();
        return true;
    }

}
