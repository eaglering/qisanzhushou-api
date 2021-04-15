<?php

namespace app\core\enums\navigator\category;

class TypeEnum
{
    /**
     * 其他
     */
    const OTHER = 0;
    /**
     * 首页推荐
     */
    const HOME_HOT = 1;
    /**
     * 首页速查
     */
    const HOME_QUICK_SEARCH = 2;
    /**
     * 首页综合
     */
    const HOME_COMPREHENSIVE = 3;
    /**
     * 文档
     */
    const DOCUMENT = 4;
    /**
     * 工具
     */
    const TOOL = 5;
    /**
     * 项目
     */
    const PROJECT = 6;

    public static function data() {
        return [
            self::HOME_HOT => [
                'label' => '首页推荐',
                'value' => self::HOME_HOT
            ],
            self::HOME_QUICK_SEARCH => [
                'label' => '首页速查',
                'value' => self::HOME_QUICK_SEARCH
            ],
            self::HOME_COMPREHENSIVE => [
                'label' => '首页综合',
                'value' => self::HOME_COMPREHENSIVE
            ],
            self::DOCUMENT => [
                'label' => '文档教程',
                'value' => self::DOCUMENT
            ],
            self::TOOL => [
                'label' => '工具助手',
                'value' => self::TOOL
            ],
            self::PROJECT => [
                'label' => '开源项目',
                'value' => self::PROJECT
            ]
        ];
    }
}
