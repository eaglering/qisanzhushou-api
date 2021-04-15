<?php
declare (strict_types = 1);

namespace app\backend\logic\phone;

use app\backend\logic\Logic;
use app\backend\model\phone\AreasModel as PhoneAreasModel;
use think\Paginator;
use app\core\logic\phone\AreasLogic as BasePhoneAreasLogic;

class AreasLogic extends BasePhoneAreasLogic implements Logic
{
    private $phoneAreasModel;

    public function __construct()
    {
        parent::__construct();
        $this->phoneAreasModel = new PhoneAreasModel();
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
        $paginator = $this->phoneAreasModel->where($where)
            ->paginate($params['limit'] ?? null);
        $this->format($paginator);
        return $paginator;
    }

    public function add($params) {
        return $this->phoneAreasModel->save($params);
    }

    public function edit($id, $params) {
        $model = $this->phoneAreasModel->where('id', '=', $id)->find();
        if (!$model) {
            $this->setError('无效的id');
            return false;
        }
        $model->save($params);
        return true;
    }

    public function view($id) {
        $model = $this->phoneAreasModel
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
        $this->phoneAreasModel->whereIn('id', $id)->delete();
        return true;
    }

}
