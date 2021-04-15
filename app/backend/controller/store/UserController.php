<?php
declare (strict_types = 1);

namespace app\backend\controller\store;

use app\backend\controller\Controller;
use app\backend\logic\store\UserLogic as StoreUserLogic;

class UserController extends Controller
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
        $logic = new StoreUserLogic();
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
        $validator = $this->validate([
            'username' => 'require',
            'password' => 'require|min:6|max:32',
            'phone' => 'require',
            'realname' => 'require'
        ]);
        if (!$validator->check($params)) {
            return $this->error($validator->getError());
        }
        $logic = new StoreUserLogic();
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
        $validator = $this->validate([
            'username' => 'require',
            'password' => 'min:6|max:32',
            'phone' => 'require',
            'realname' => 'require'
        ]);
        if (!$validator->check($params)) {
            return $this->error($validator->getError());
        }
        $logic = new StoreUserLogic();
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
            'permissions' => 'require|array',
            'roles' => 'require|array'
        ]);
        if (!$validator->check($params)) {
            return $this->error($validator->getError());
        }
        $logic = new StoreUserLogic();
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
        $logic = new StoreUserLogic();
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
        $logic = new StoreUserLogic();
        $logic->delete($id);
        return $this->success();
    }

    /**
     * 修改状态
     * @param $id
     * @return \think\response\Json
     */
    public function state($id) {
        $params = $this->request->param();
        $validator = $this->validate([
            'is_lock' => 'require|in:0,1'
        ]);
        if (!$validator->check($params)) {
            return $this->error($validator->getError());
        }
        $logic = new StoreUserLogic();
        if (!$logic->state($id, $params)) {
            return $this->error($logic->getError());
        }
        return $this->success();
    }
}
