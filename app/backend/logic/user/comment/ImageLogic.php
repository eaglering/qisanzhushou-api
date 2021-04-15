<?php
declare (strict_types = 1);

namespace app\backend\logic\user\comment;

use app\backend\logic\Logic;
use app\backend\model\user\comment\ImageModel as UserCommentImageModel;
use think\Paginator;
use app\core\logic\user\comment\ImageLogic as BaseUserCommentImageLogic;

class ImageLogic extends BaseUserCommentImageLogic implements Logic
{
    private $userCommentImageModel;

    public function __construct()
    {
        parent::__construct();
        $this->userCommentImageModel = new UserCommentImageModel();
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
        $paginator = $this->userCommentImageModel->where($where)
            ->paginate($params['limit'] ?? null);
        $this->format($paginator);
        return $paginator;
    }

    public function add($params) {
        return $this->userCommentImageModel->save($params);
    }

    public function edit($id, $params) {
        $model = $this->userCommentImageModel->where('id', '=', $id)->find();
        if (!$model) {
            $this->setError('无效的id');
            return false;
        }
        $model->save($params);
        return true;
    }

    public function view($id) {
        $model = $this->userCommentImageModel
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
        $this->userCommentImageModel->whereIn('id', $id)->delete();
        return true;
    }

}
