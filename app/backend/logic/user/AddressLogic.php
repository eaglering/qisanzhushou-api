<?php
declare (strict_types = 1);

namespace app\backend\logic\user;

use app\backend\logic\Logic;
use app\backend\model\user\AddressModel as UserAddressModel;
use think\Paginator;
use app\core\logic\user\AddressLogic as BaseUserAddressLogic;

class AddressLogic extends BaseUserAddressLogic implements Logic
{
    private $userAddressModel;

    public function __construct()
    {
        parent::__construct();
        $this->userAddressModel = new UserAddressModel();
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
        $paginator = $this->userAddressModel->where($where)
            ->paginate($params['limit'] ?? null);
        $this->format($paginator);
        return $paginator;
    }

    public function add($params) {
        return $this->userAddressModel->save($params);
    }

    public function edit($id, $params) {
        $model = $this->userAddressModel->where('id', '=', $id)->find();
        if (!$model) {
            $this->setError('无效的id');
            return false;
        }
        $model->save($params);
        return true;
    }

    public function view($id) {
        $model = $this->userAddressModel
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
        $this->userAddressModel->whereIn('id', $id)->delete();
        return true;
    }

}
