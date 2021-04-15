<?php
declare(strict_types=1);

namespace app\backend\controller;

use app\backend\logic\store\UserLogic as StoreUserLogic;
use app\core\enums\ResponseEnum;

class PassportController extends Controller
{
    public function login() {
        $params = $this->request->param();
        $validator = $this->validate([
            'username' => 'require',
            'password' => 'require'
        ], [
            'username.require' => '账号必填',
            'password.require' => '密码必填'
        ]);
        if (!$validator->check($params)) {
            return $this->error($validator->getError());
        }
        $storeUserLogic = new StoreUserLogic;
        $result = $storeUserLogic->login($params);
        if ($result === false) {
            return $this->error($storeUserLogic->getError());
        }
        return $this->success($result, '登录成功');
    }
}
