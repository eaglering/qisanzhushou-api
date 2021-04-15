<?php
declare (strict_types = 1);

namespace app\backend\logic\upload;

use app\backend\logic\Logic;
use app\backend\model\upload\GroupModel as UploadGroupModel;
use think\Collection;
use think\Paginator;
use app\core\logic\upload\GroupLogic as BaseUploadGroupLogic;

class GroupLogic extends BaseUploadGroupLogic implements Logic
{
    private $uploadGroupModel;

    public function __construct()
    {
        parent::__construct();
        $this->uploadGroupModel = new UploadGroupModel();
    }

    protected function filter($params) {
        $where = [];
        if (!empty($params['type'])) {
            $where[] = ['type', '=', $params['type']];
        }
        return $where;
    }

    /**
     * @param Collection $paginator
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
        $paginator = $this->uploadGroupModel->where($where)
            ->where('is_delete', '=', 0)
            ->order('sort', 'asc')
            ->select();
        $this->format($paginator);
        return $paginator;
    }

    public function add($params) {
        return $this->uploadGroupModel->save($params);
    }

    public function edit($id, $params) {
        $model = $this->uploadGroupModel->where('id', '=', $id)->find();
        if (!$model) {
            $this->setError('无效的id');
            return false;
        }
        $model->save($params);
        return true;
    }

    public function view($id) {
        $model = $this->uploadGroupModel
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
        $this->uploadGroupModel->whereIn('id', $id)->delete();
        return true;
    }

}
