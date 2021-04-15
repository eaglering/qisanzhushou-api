<?php
declare(strict_types=1);

namespace app\backend\middleware;

use thans\jwt\exception\JWTException;
use thans\jwt\exception\TokenBlacklistException;
use thans\jwt\JWTAuth as Auth;
use thans\jwt\exception\TokenExpiredException;
use thans\jwt\middleware\BaseMiddleware;
use think\facade\Log;

class JWTAuthAndRefreshMiddleware extends BaseMiddleware
{
    /**
     * @var Auth
     */
    protected $auth;

    public function handle($request, \Closure $next)
    {
        try {
            $this->auth->auth();
        } catch (TokenExpiredException $e) {
            $this->auth->setRefresh();
            $response = $next($request);
            return $this->setAuthentication($response);
        } catch (\Throwable $e) {
        }

        return $next($request);
    }
}
