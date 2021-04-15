<?php
declare (strict_types = 1);

namespace app\backend\logic;

use app\backend\logic\Logic;
use app\backend\model\ExpressModel as ExpressModel;
use think\Paginator;
use app\core\logic\ExpressLogic as BaseExpressLogic;

class ExpressLogic extends BaseExpressLogic implements Logic
{
    private $expressModel;

    public function __construct()
    {
        parent::__construct();
        $this->expressModel = new ExpressModel();
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
        $paginator = $this->expressModel->where($where)
            ->paginate($params['limit'] ?? null);
        $this->format($paginator);
        return $paginator;
    }

    public function add($params) {
        return $this->expressModel->save($params);
    }

    public function edit($id, $params) {
        $model = $this->expressModel->where('id', '=', $id)->find();
        if (!$model) {
            $this->setError('无效的id');
            return false;
        }
        $model->save($params);
        return true;
    }

    public function view($id) {
        $model = $this->expressModel
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
        $this->expressModel->whereIn('id', $id)->delete();
        return true;
    }

}
