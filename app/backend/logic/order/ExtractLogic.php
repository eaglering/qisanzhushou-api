<?php
declare (strict_types = 1);

namespace app\backend\logic\order;

use app\backend\logic\Logic;
use app\backend\model\order\ExtractModel as OrderExtractModel;
use think\Paginator;
use app\core\logic\order\ExtractLogic as BaseOrderExtractLogic;

class ExtractLogic extends BaseOrderExtractLogic implements Logic
{
    private $orderExtractModel;

    public function __construct()
    {
        parent::__construct();
        $this->orderExtractModel = new OrderExtractModel();
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
        $paginator = $this->orderExtractModel->where($where)
            ->paginate($params['limit'] ?? null);
        $this->format($paginator);
        return $paginator;
    }

    public function add($params) {
        return $this->orderExtractModel->save($params);
    }

    public function edit($id, $params) {
        $model = $this->orderExtractModel->where('id', '=', $id)->find();
        if (!$model) {
            $this->setError('无效的id');
            return false;
        }
        $model->save($params);
        return true;
    }

    public function view($id) {
        $model = $this->orderExtractModel
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
        $this->orderExtractModel->whereIn('id', $id)->delete();
        return true;
    }

}
