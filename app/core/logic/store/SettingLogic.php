<?php
declare(strict_types=1);

namespace app\core\logic\store;

use app\core\enums\DeliveryTypeEnum;
use app\core\enums\store\settings\KeyEnum;
use app\core\logic\Logic;
use think\facade\App;
use think\facade\Cache;
use app\core\model\store\SettingModel as StoreSettingModel;

class SettingLogic extends Logic
{
    private $settingModel;

    public function __construct()
    {
        $this->settingModel = new StoreSettingModel;
    }

    public function getItem($key)
    {
        $data = $this->getAll();
        return isset($data[$key]) ? $data[$key]['values'] : [];
    }

    public function getAll() {
        if (App::debug() || !$data = Cache::get('store_setting')) {
            $data = $this->settingModel->select()->column(null, 'key');
            Cache::tag('cache')->set('store_setting', $data);
        }
        return array_merge_multiple($this->defaultData(), $data);
    }

    protected function defaultData()
    {
        $map = KeyEnum::data();
        return [
            KeyEnum::STORE => [
                'key' => KeyEnum::STORE,
                'describe' => $map[KeyEnum::STORE],
                'values' => [
                    // 商城名称
                    'name' => '程序之窗',
                    // 客服电话
                    'service_tel' => '10086'
                ],
            ],
            KeyEnum::MAIL => [
                'key' => KeyEnum::MAIL,
                'describe' => $map[KeyEnum::MAIL],
                'values' => [
                    'default_engine' => 'aliyun',
                    'engine' => [
                        'aliyun' => [
                            'host' => 'smtpdm.aliyun.com',
                            'port' => 25,
                            'username' => '',
                            'password' => '',
                            'from' => '',
                        ]
                    ]
                ]
            ],
            KeyEnum::STORAGE => [
                'key' => KeyEnum::STORAGE,
                'describe' => $map[KeyEnum::STORAGE],
                'values' => [
                    'default_engine' => 'local',
                    'engine' => [
                        'local' => [],
                        'qiniu' => [
                            'bucket' => '',
                            'access_key' => '',
                            'secret_key' => '',
                            'domain' => 'http://'
                        ],
                        'aliyun' => [
                            'bucket' => '',
                            'access_key_id' => '',
                            'access_key_secret' => '',
                            'domain' => 'http://'
                        ],
                        'qcloud' => [
                            'bucket' => '',
                            'region' => '',
                            'secret_id' => '',
                            'secret_key' => '',
                            'domain' => 'http://'
                        ],
                    ]
                ],
            ],
            KeyEnum::SMS => [
                'key' => KeyEnum::SMS,
                'describe' => $map[KeyEnum::SMS],
                'values' => [
                    'default_engine' => 'aliyun',
                    'engine' => [
                        'aliyun' => [
                            'AccessKeyId' => '',
                            'AccessKeySecret' => '',
                            'sign' => '程序之窗',
                            'order_pay' => [
                                'is_enable' => 0,
                                'template_code' => '',
                                'accept_phone' => '',
                            ],
                            'partner_template' => [
                                'template_type' => 1,
                                'remark' => '当前短信模版应用于通知用户绑定电子券'
                            ]
                        ],
                    ],
                ],
            ]
        ];
    }
}
