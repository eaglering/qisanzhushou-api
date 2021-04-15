<?php
// 全局中间件定义文件

return [
    // 全局请求缓存
    // \think\middleware\CheckRequestCache::class,
    // 多语言加载
    // \think\middleware\LoadLangPack::class,
    // Session初始化
    // \think\middleware\SessionInit::class
    // JWT Token续期
    \app\backend\middleware\JWTAuthAndRefreshMiddleware::class,
    // 身份验证
    \app\backend\middleware\AuthenticateMiddleware::class,
    // 鉴权
    \app\backend\middleware\AuthorizeMiddleware::class

];
