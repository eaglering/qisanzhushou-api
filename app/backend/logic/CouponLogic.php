<?php
declare (strict_types = 1);

namespace app\backend\logic;

use app\backend\logic\Logic;
use app\backend\model\CouponModel as CouponModel;
use think\db\concern\WhereQuery;
use think\Paginator;
use app\core\logic\CouponLogic as BaseCouponLogic;

class CouponLogic extends BaseCouponLogic implements Logic
{
    private $couponModel;

    public function __construct()
    {
        parent::__construct();
        $this->couponModel = new CouponModel();
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
        $paginator = $this->couponModel->where($where)
            ->order('sort', 'desc')
            ->order('created_at', 'desc')
            ->with(['goods.category'])
            ->append(['coupon_type_text', 'apply_range_text'])
            ->paginate($params['limit'] ?? null);
        $this->format($paginator);
        return $paginator;
    }

    public function add($params) {
        return $this->couponModel->save($params);
    }

    public function edit($id, $params) {
        $model = $this->couponModel->where('id', '=', $id)->find();
        if (!$model) {
            $this->setError('无效的id');
            return false;
        }
        $model->save($params);
        return true;
    }

    public function view($id) {
        $model = $this->couponModel
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
        $this->couponModel->whereIn('id', $id)->delete();
        return true;
    }

}
