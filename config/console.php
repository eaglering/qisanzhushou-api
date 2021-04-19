<?php
// +----------------------------------------------------------------------
// | 控制台配置
// +----------------------------------------------------------------------
return [
    // 指令定义
    'commands' => [
        'navigator.site:capture' => \app\console\command\navigator\site\CaptureCommand::class,
        'make:mvc' => \app\console\command\make\MvcCommand::class,
        'test' => \app\console\command\TestCommand::class
    ],
];
