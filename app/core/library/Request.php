<?php
namespace app\core\library;

// 应用请求对象类
use app\core\model\store\UserModel;
use think\Exception;

/**
 * Class Request
 * @property UserModel $identifier
 * @package app\core\library
 */
class Request extends \think\Request
{
    public function setMiddleware($name, $middleware, $lock = true) {
        if ($lock && isset($this->middleware[$name])) {
            throw new Exception("Middleware {$name} already exist");
        }
        $this->middleware[$name] = $middleware;
    }
}
