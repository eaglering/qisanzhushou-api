<?php
declare (strict_types = 1);

namespace app\backend\controller\store;

use app\backend\controller\Controller;
use app\backend\logic\store\RoleLogic as StoreRoleLogic;

class RoleController extends Controller
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
        $logic = new StoreRoleLogic();
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
        $logic = new StoreRoleLogic();
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
        $logic = new StoreRoleLogic();
        if (!$logic->edit($id, $params)) {
            return $this->error($logic->getError());
        }
        return $this->success();
    }

    /**
     * 授权
     * @param int $id
     * @return \think\Response
     */
    public function grant($id)
    {
        $params = $this->request->param();
        $validator = $this->validate([
            'permissions' => 'require|array'
        ]);
        if (!$validator->check($params)) {
            return $this->error($validator->getError());
        }
        $logic = new StoreRoleLogic();
        if (!$logic->grant($id, $params)) {
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
        $logic = new StoreRoleLogic();
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
        $logic = new StoreRoleLogic();
        $logic->delete($id);
        return $this->success();
    }

    /**
     * 获取树结构
     * @return \think\response\Json
     */
    public function tree()
    {
        $logic = new StoreRoleLogic();
        $data = $logic->tree();
        return $this->success($data);
    }
}
