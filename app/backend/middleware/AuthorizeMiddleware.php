<?php
declare(strict_types=1);

namespace app\backend\middleware;

use app\core\library\Request;
use think\Response;
use app\backend\logic\store\user\PermissionLogic as StoreUserPermissionLogic;

class AuthorizeMiddleware
{
    protected $allowAction = [
        // 页面入口
        '',
        // 用户登录
        'passport/login',
        // 退出登录
        'passport/logout',
        // 修改当前用户信息
        'store.user/renew',
        // 文件库
        'upload.library/*',
        // 图片上传
        'upload/image',
        // 数据选择
        'data/*',
    ];

    /**
     * @param Request $request
     * @param \Closure $next
     * @return mixed|Response
     */
    public function handle($request, \Closure $next)
    {
        $url = $request->pathinfo();
        if (in_array($url, $this->allowAction)) {
            return $next($request);
        }
        $identifier = $request->identifier;
        if (!$identifier) {
            return json(['code' => 401, 'msg' => '请先登录']);
        }
        $storeUserPermissionLogic = new StoreUserPermissionLogic;
        $hasPrivilege = $storeUserPermissionLogic->checkAccess($identifier, $url, $this->allowAction);
        if (!$hasPrivilege) {
            return json(['code' => 403, 'msg' => '您没有访问权限']);
        }
        return $next($request);
    }
}
