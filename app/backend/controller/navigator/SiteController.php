<?php
declare(strict_types=1);

namespace app\backend\controller\navigator;

use app\backend\logic\navigator\SiteLogic as NavigatorSiteLogic;
use app\backend\controller\Controller;
use app\core\enums\ResponseEnum;

class SiteController extends Controller
{
    public function list() {
        $params = $this->request->param();
        $validator = $this->validate([
            'type' => 'number',
            'category_id' => 'number',
            'is_hot' => 'in:0,1',
            'status' => 'in:10,20',
            'is_captured' => 'in:0,1'
        ]);
        if (!$validator->check($params)) {
            return $this->error($validator->getError());
        }
        $logic = new NavigatorSiteLogic();
        $paginator = $logic->paginator($params);
        return $this->paginator($paginator);
    }

    public function add() {
        $params = $this->request->param();
        $validator = $this->validate([
            'url' => 'require',
            'category_id' => 'require|number',
            'sort' => 'require|number'
        ]);
        if (!$validator->check($params)) {
            return $this->error(ResponseEnum::ERROR, $validator->getError());
        }
        $logic = new NavigatorSiteLogic();
        if (!$logic->add($params)) {
            return $this->error($logic->getError());
        }
        return $this->success();
    }

    public function edit($id) {
        $params = $this->request->param();
        $validator = $this->validate([
            'url' => 'require|url',
            'category_id' => 'require|number',
            'sort' => 'require|number',
            'status' => 'require|number',
            'is_captured' => 'require|number'
        ]);
        if (!$validator->check($params)) {
            return $this->error(ResponseEnum::ERROR, $validator->getError());
        }
        $logic = new NavigatorSiteLogic();
        if (!$logic->edit($id, $params)) {
            return $this->error($logic->getError());
        }
        return $this->success();
    }

    public function delete($id) {
        $logic = new NavigatorSiteLogic();
        $logic->delete($id);
        return $this->success();
    }

    public function view($id) {
        $logic = new NavigatorSiteLogic();
        $view = $logic->view($id);
        if (!$view) {
            return $this->error($logic->getError());
        }
        return $this->success($view);
    }

    public function state($id) {
        $params = $this->request->param();
        $validator = $this->validate([
            'status' => 'number',
            'is_captured' => 'number',
            'is_hot' => 'number'
        ]);
        if (!$validator->check($params)) {
            return $this->error(ResponseEnum::ERROR, $validator->getError());
        }
        $logic = new NavigatorSiteLogic();
        if (!$logic->state($id, $params)) {
            return $this->error($logic->getError());
        }
        return $this->success();
    }
}
