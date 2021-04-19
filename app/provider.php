<?php

use app\core\library\ExceptionHandle;
use app\core\library\Request;

// 容器Provider定义文件
return [
    'think\Request'          => Request::class,
    'think\exception\Handle' => ExceptionHandle::class
];
