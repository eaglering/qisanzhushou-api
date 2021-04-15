<?php
declare (strict_types = 1);

namespace app\backend\logic\delivery;

use app\backend\logic\Logic;
use app\backend\model\delivery\RuleModel as DeliveryRuleModel;
use think\Paginator;
use app\core\logic\delivery\RuleLogic as BaseDeliveryRuleLogic;

class RuleLogic extends BaseDeliveryRuleLogic implements Logic
{
    private $deliveryRuleModel;

    public function __construct()
    {
        parent::__construct();
        $this->deliveryRuleModel = new DeliveryRuleModel();
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
        $paginator = $this->deliveryRuleModel->where($where)
            ->paginate($params['limit'] ?? null);
        $this->format($paginator);
        return $paginator;
    }

    public function add($params) {
        return $this->deliveryRuleModel->save($params);
    }

    public function edit($id, $params) {
        $model = $this->deliveryRuleModel->where('id', '=', $id)->find();
        if (!$model) {
            $this->setError('无效的id');
            return false;
        }
        $model->save($params);
        return true;
    }

    public function view($id) {
        $model = $this->deliveryRuleModel
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
        $this->deliveryRuleModel->whereIn('id', $id)->delete();
        return true;
    }

}
