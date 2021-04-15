<?php
declare (strict_types = 1);

namespace app\backend\logic\returned;

use app\backend\logic\Logic;
use app\backend\model\returned\AddressModel as ReturnedAddressModel;
use think\Paginator;
use app\core\logic\returned\AddressLogic as BaseReturnedAddressLogic;

class AddressLogic extends BaseReturnedAddressLogic implements Logic
{
    private $returnedAddressModel;

    public function __construct()
    {
        parent::__construct();
        $this->returnedAddressModel = new ReturnedAddressModel();
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
        $paginator = $this->returnedAddressModel->where($where)
            ->paginate($params['limit'] ?? null);
        $this->format($paginator);
        return $paginator;
    }

    public function add($params) {
        return $this->returnedAddressModel->save($params);
    }

    public function edit($id, $params) {
        $model = $this->returnedAddressModel->where('id', '=', $id)->find();
        if (!$model) {
            $this->setError('无效的id');
            return false;
        }
        $model->save($params);
        return true;
    }

    public function view($id) {
        $model = $this->returnedAddressModel
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
        $this->returnedAddressModel->whereIn('id', $id)->delete();
        return true;
    }

}
