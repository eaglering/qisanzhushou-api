<?php
declare(strict_types=1);

namespace app\frontend\controller;

use think\App;
use think\facade\View;

abstract class Controller extends \app\core\controller\Controller
{
    // 初始化
    protected function initialize()
    {
        $module = $this->app->http->getName();
        $controller = $this->request->controller(true);
        $action = $this->request->action(true);
        View::assign([
            'base_url' => '/',
            'controller' => $controller,
            'action' => $action,
            'asset' => '/static',
            'base_asset' => '/static/' . $module,
            'plugin_asset' => '/static/plugins',
            'upload_url' => '/uploads'
        ]);
    }
}
