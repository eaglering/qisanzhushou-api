<?php
declare(strict_types=1);

namespace app\core\enums\store\settings;

class KeyEnum
{
    const STORE = 'store';
    const TRADE = 'trade';
    const MAIL = 'mail';
    const SMS = 'sms';
    const TEMPLATE = 'template';
    const STORAGE = 'storage';

    public static function data() {
        return [
            self::STORE => [
                'label' => '商城设置',
                'value' => self::STORE
            ],
            self::TRADE => [
                'label' => '交易设置',
                'value' => self::TRADE
            ],
            self::MAIL => [
                'label' => '邮件设置',
                'value' => self::MAIL
            ],
            self::SMS => [
                'label' => '短信设置',
                'value' => self::SMS
            ],
            self::TEMPLATE => [
                'label' => '模板设置',
                'value' => self::TEMPLATE
            ],
            self::STORAGE => [
                'label' => '存储设置',
                'value' => self::STORAGE
            ]
        ];
    }
}
