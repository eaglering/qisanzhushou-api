<?php
declare (strict_types = 1);

namespace app\backend\logic\express;

use app\backend\logic\Logic;
use app\backend\model\express\ConfigModel as ExpressConfigModel;
use think\Paginator;
use app\core\logic\express\ConfigLogic as BaseExpressConfigLogic;

class ConfigLogic extends BaseExpressConfigLogic implements Logic
{
    private $expressConfigModel;

    public function __construct()
    {
        parent::__construct();
        $this->expressConfigModel = new ExpressConfigModel();
    }

    protected function filter($params) {
        $where = [];
        if (filterable_string($params, 'keyword')) {
            $where[] = ['name|code', 'like', '%' . $params['keyword'] . '%'];
        }
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
        $paginator = $this->expressConfigModel->where($where)
            ->paginate($params['limit'] ?? null);
        $this->format($paginator);
        return $paginator;
    }

    public function add($params) {
        return $this->expressConfigModel->insertAll($params);
    }

    public function edit($id, $params) {
        $model = $this->expressConfigModel->where('id', '=', $id)->find();
        if (!$model) {
            $this->setError('无效的id');
            return false;
        }
        $model->save($params);
        return true;
    }

    public function view($id) {
        $model = $this->expressConfigModel
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
        $this->expressConfigModel->whereIn('id', $id)->delete();
        return true;
    }

}
