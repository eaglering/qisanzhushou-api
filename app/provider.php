<?php

use app\core\library\App;
use app\core\library\ExceptionHandle;
use app\core\library\Request;

// 容器Provider定义文件
return [
    'think\App'              => App::class,
    'think\Request'          => Request::class,
    'think\exception\Handle' => ExceptionHandle::class
];
