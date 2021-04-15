<?php
declare (strict_types = 1);

namespace app\backend\controller\store\role;

use app\backend\controller\Controller;
use app\backend\logic\store\role\PermissionLogic as StoreRolePermissionLogic;

class PermissionController extends Controller
{
    /**
     * 列表
     * @return \think\response\Json
     */
    public function list()
    {
        $params = $this->request->param();
        $validator = $this->validate([]);
        if (!$validator->check($params)) {
            return $this->error($validator->getError());
        }
        $logic = new StoreRolePermissionLogic();
        $paginator = $logic->paginator($params);
        return $this->paginator($paginator);
    }

    /**
     * 添加
     * @return \think\response\Json
     */
    public function add()
    {
        $params = $this->request->param();
        $validator = $this->validate([]);
        if (!$validator->check($params)) {
            return $this->error($validator->getError());
        }
        $logic = new StoreRolePermissionLogic();
        if (!$logic->add($params)) {
            return $this->error($logic->getError());
        }
        return $this->success();
    }

    /**
     * 编辑
     * @param int $id
     * @return \think\Response
     */
    public function edit($id)
    {
        $params = $this->request->param();
        $validator = $this->validate([]);
        if (!$validator->check($params)) {
            return $this->error($validator->getError());
        }
        $logic = new StoreRolePermissionLogic();
        if (!$logic->edit($id, $params)) {
            return $this->error($logic->getError());
        }
        return $this->success();
    }

    /**
     * 详情
     * @param int $id
     * @return \think\response\Json
     */
    public function view($id)
    {
        $logic = new StoreRolePermissionLogic();
        $view = $logic->view($id);
        if (!$view) {
            return $this->error($logic->getError());
        }
        return $this->success($view);
    }

    /**
     * 删除
     * @param int $id
     * @return \think\response\Json
     */
    public function delete($id)
    {
        $logic = new StoreRolePermissionLogic();
        $logic->delete($id);
        return $this->success();
    }
}
