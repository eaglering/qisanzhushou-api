<?php
declare (strict_types = 1);

namespace app\backend\logic;

use app\backend\model\DeliveryModel as DeliveryModel;
use app\backend\model\RegionModel;
use think\Paginator;
use app\core\logic\DeliveryLogic as BaseDeliveryLogic;
use app\backend\model\delivery\RuleModel as DeliveryRuleModel;

class DeliveryLogic extends BaseDeliveryLogic implements Logic
{
    private $deliveryModel;
    private $deliveryRuleModel;

    public function __construct()
    {
        parent::__construct();
        $this->deliveryModel = new DeliveryModel();
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
        $paginator = $this->deliveryModel->where($where)
            ->append(['method_text'])
            ->paginate($params['limit'] ?? null);
        $this->format($paginator);
        return $paginator;
    }

    public function add($params) {
        $rules = [];
        foreach ($params['rules'] as $rule) {
            $rule['first_fee_fen'] = floor($rule['first_fee'] * 100);
            $rule['additional_fee_fen'] = floor($rule['additional_fee'] * 100);
            $rules[] = $rule;
        }
        $this->deliveryModel->startTrans();
        try {
            $this->deliveryModel->save($params);
            $rules && $this->deliveryModel->rules()->saveAll($rules);
            $this->deliveryModel->commit();
        } catch (\Exception $e) {
            $this->deliveryModel->rollback();
            throw $e;
        }
        return true;
    }

    public function edit($id, $params) {
        /** @var DeliveryModel $model */
        $model = $this->deliveryModel->where('id', '=', $id)->find();
        if (!$model) {
            $this->setError('无效的id');
            return false;
        }
        $rules = [];
        foreach ($params['rules'] as $rule) {
            $rule['first_fee_fen'] = floor($rule['first_fee'] * 100);
            $rule['additional_fee_fen'] = floor($rule['additional_fee'] * 100);
            $rules[] = $rule;
        }
        $model->startTrans();
        try {
            $model->save($params);
            $model->rules()->where('delivery_id', '=', $model['id'])->delete();
            $rules && $model->rules()->saveAll($rules);
            $model->commit();
        } catch (\Exception $e) {
            $model->rollback();
            throw $e;
        }
        return true;
    }

    public function view($id) {
        $model = $this->deliveryModel
            ->where('id', '=', $id)
            ->append(['method_text', 'rules'])
            ->find();
        if (!$model) {
            $this->error = '无效的id';
            return false;
        }
        $regions = collect($model['rules'])->column('region');
        $regionIds = [];
        foreach ($regions as $region) {
            $region && $regionIds = array_merge($regionIds, explode(',', $region));
        }
        $regionModel = new RegionModel;
        $regionRefs = $regionModel->whereIn('id', $regionIds)->column('*', 'id');
        collect($model['rules'])->map(function ($item) use ($regionRefs) {
            $region = [];
            if ($item['region']) {
                $regionIds = explode(',', $item['region']);
                foreach ($regionIds as $id) {
                    isset($regionRefs[$id]) && $region[] = $regionRefs[$id];
                }
            }
            $item['region'] = $region;
            return $item;
        });
        return $model;
    }

    public function delete($id) {
        $id = explode(',', $id);
        $models = $this->deliveryModel->whereIn('id', $id)->with(['goods'])->select();
        $errors = [];
        $this->deliveryModel->startTrans();
        try {
            /** @var DeliveryModel $model */
            foreach ($models as $model) {
                if ($model['goods']) {
                    $goodsNames = collect($models['goods'])->column('goods_name');
                    $errors[] = '运费模板【' . $model['name'] . '】被商品' . implode(';', $goodsNames) . '使用中，不可删除';
                } else {
                    $model->delete();
                    $model->rules()->delete();
                }
            }
            $this->deliveryModel->commit();
        } catch (\Exception $e) {
            $this->deliveryModel->rollback();
            throw $e;
        }
        $this->setError(implode(PHP_EOL, $errors));
        return $errors ? true : false;
    }

}
