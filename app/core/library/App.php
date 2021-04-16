<?php
declare(strict_types=1);

namespace app\core\library;

class App extends \think\App
{
    public static function env() {
        return \env('APP_ENV', 'prod');
    }

    public static function isDev() {
        return self::env() === 'dev';
    }

    public static function isProd() {
        return self::env() === 'prod';
    }
}
