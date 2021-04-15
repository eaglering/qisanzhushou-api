<?php
declare(strict_types=1);

namespace app\core\enums\upload\group;

class TypeEnum
{
    const IMAGE = 10;

    const FILE = 20;

    public static function data() {
        return [
            self::IMAGE => [
                'label' => '图片',
                'value' => self::IMAGE
            ],
            self::FILE => [
                'label' => '文件',
                'value' => self::FILE
            ]
        ];
    }
}
