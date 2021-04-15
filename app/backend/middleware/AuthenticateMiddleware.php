<?php
declare(strict_types=1);

namespace app\backend\middleware;

use app\core\library\Request;
use thans\jwt\exception\JWTException;
use thans\jwt\facade\JWTAuth;
use think\App;
use think\Exception;
use think\Response;
use app\backend\logic\store\UserLogic as StoreUserLogic;

class AuthenticateMiddleware
{
    protected $allowAction = [
        // 页面入口
        '',
        // 登录页面
        'passport/login'
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
        try {
            $payload = JWTAuth::auth();
            if (!$payload || empty($payload['uid'])) {
                throw new JWTException('无效的token');
            }
        } catch (\Throwable $e) {
            throw new Exception('登录失败，请重新登录', 401, $e);
        }
        $storeUserLogic = new StoreUserLogic;
        $identifier = $storeUserLogic->getLoginUserById($payload['uid']);
        $request->setMiddleware('identifier', $identifier);
        return $next($request);
    }
}
