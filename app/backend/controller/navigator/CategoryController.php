<?php
declare(strict_types=1);

namespace app\backend\controller\navigator;

use app\backend\controller\Controller;
use app\backend\logic\navigator\CategoryLogic as NavigatorCategoryLogic;
use app\core\enums\ResponseEnum;

class CategoryController extends Controller
{
    /**
     * @return \think\response\Json
     */
    public function list() {
        $params = $this->request->param();
        $validator = $this->validate([
            'type' => 'number',
            'parent_category_id' => 'number'
        ]);
        if (!$validator->check($params)) {
            return $this->error($validator->getError());
        }
        $logic = new NavigatorCategoryLogic();
        $paginator = $logic->paginator($params);
        return $this->paginator($paginator);
    }

    /**
     * @return \think\response\Json
     */
    public function add() {
        $params = $this->request->param();
        $validator = $this->validate([
            'type' => 'require|number',
            'name' => 'require',
            'parent_id' => 'require|number',
            'sort' => 'require|number'
        ]);
        if (!$validator->check($params)) {
            return $this->error($validator->getError());
        }
        $logic = new NavigatorCategoryLogic();
        if (!$logic->add($params)) {
            return $this->error($logic->getError());
        }
        return $this->success();
    }

    public function edit($id) {
        $params = $this->request->param();
        $validator = $this->validate([
            'type' => 'require|number',
            'name' => 'require',
            'parent_id' => 'require|number',
            'sort' => 'require|number'
        ]);
        if (!$validator->check($params)) {
            return $this->error($validator->getError());
        }
        $logic = new NavigatorCategoryLogic();
        if (!$logic->edit($id, $params)) {
            return $this->error($logic->getError());
        }
        return $this->success();
    }

    public function delete($id) {
        $logic = new NavigatorCategoryLogic();
        if (!$logic->delete($id)) {
            return $this->error($logic->getError());
        }
        return $this->success();
    }

    public function view($id) {
        $logic = new NavigatorCategoryLogic();
        $view = $logic->view($id);
        if (!$view) {
            return $this->error($logic->getError());
        }
        return $this->success($view);
    }
}
