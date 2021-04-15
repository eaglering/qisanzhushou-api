<?php
declare(strict_types=1);

namespace app\core\driver\sms\engine;

use app\common\library\sms\package\aliyun\SignatureHelper;
use app\core\driver\sms\package\aliyun\ErrorCode;
use think\facade\Log;

/**
 * 阿里云短信模块引擎
 * Class Aliyun
 * @package app\common\library\sms\engine
 */
class Aliyun extends Server
{
    private $config;

    /**
     * 构造方法
     * Qiniu constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * 发送短信通知
     * @param $msgType
     * @param $templateParams
     * @return bool|\stdClass
     */
    public function sendSms($msgType, $templateParams)
    {
        $params = [];
        // *** 需用户填写部分 ***

        // 必填: 短信接收号码
        $params["PhoneNumbers"] = $this->config[$msgType]['accept_phone'];

        // 必填: 短信签名，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
        $params["SignName"] = $this->config['sign'];

        // 必填: 短信模板Code，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
        $params["TemplateCode"] = $this->config[$msgType]['template_code'];

        // 可选: 设置模板参数, 假如模板中存在变量需要替换则为必填项
        $params['TemplateParam'] = $templateParams;

        // 可选: 设置发送短信流水号
        // $params['OutId'] = "12345";

        // 可选: 上行短信扩展码, 扩展码字段控制在7位或以下，无特殊需求用户请忽略此字段
        // $params['SmsUpExtendCode'] = "1234567";

        // *** 需用户填写部分结束, 以下代码若无必要无需更改 ***
        if (!empty($params["TemplateParam"]) && is_array($params["TemplateParam"])) {
            $params["TemplateParam"] = json_encode($params["TemplateParam"], JSON_UNESCAPED_UNICODE);
        }

        // 初始化SignatureHelper实例用于设置参数，签名以及发送请求
        $helper = new SignatureHelper;

        // 此处可能会抛出异常，注意catch
        $response = $helper->request(
            $this->config['AccessKeyId']
            , $this->config['AccessKeySecret']
            , "dysmsapi.aliyuncs.com"
            , array_merge($params, [
                "RegionId" => "cn-hangzhou",
                "Action" => "SendSms",
                "Version" => "2017-05-25",
            ])
            // 选填: 启用https
            , true
        );
        Log::info('Signature::request', [
            'config' => $this->config,
            'params' => $params,
            'response' => $response
        ]);
        $this->setError($response->Message);
        return $response->Code === 'OK';
    }

    public function sendBatchSms($msgType, $templateParams)
    {
        $params = [];
        // *** 需用户填写部分 ***

        // 必填: 短信接收号码
        $params["PhoneNumberJson"] = $msgType['accept_phone'];

        // 必填: 短信签名，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
        $params["SignNameJson"] = array_fill(0, count($msgType['accept_phone']), $this->config['sign']);

        // 必填: 短信模板Code，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
        $params["TemplateCode"] = $msgType['template_code'];

        // 可选: 设置模板参数, 假如模板中存在变量需要替换则为必填项
        $params['TemplateParamJson'] = $templateParams;

        // 可选: 上行短信扩展码, 扩展码字段控制在7位或以下，无特殊需求用户请忽略此字段
        // $params['SmsUpExtendCodeJson'] = json_encode(["1234567"], JSON_UNESCAPED_SLASHES);

        // *** 需用户填写部分结束, 以下代码若无必要无需更改 ***
        if (!empty($params["SignNameJson"]) && is_array($params["SignNameJson"])) {
            $params["SignNameJson"] = json_encode($params["SignNameJson"]);
        }
        if (!empty($params["PhoneNumberJson"]) && is_array($params["PhoneNumberJson"])) {
            $params["PhoneNumberJson"] = json_encode($params["PhoneNumberJson"]);
        }
        if (!empty($params["TemplateParamJson"]) && is_array($params["TemplateParamJson"])) {
            $params["TemplateParamJson"] = json_encode($params["TemplateParamJson"], JSON_UNESCAPED_UNICODE);
        }

        // 初始化SignatureHelper实例用于设置参数，签名以及发送请求
        $helper = new SignatureHelper;

        // 此处可能会抛出异常，注意catch
        $response = $helper->request(
            $this->config['AccessKeyId']
            , $this->config['AccessKeySecret']
            , "dysmsapi.aliyuncs.com"
            , array_merge($params, [
                "RegionId" => "cn-hangzhou",
                "Action" => "SendBatchSms",
                "Version" => "2017-05-25",
            ])
            // 选填: 启用https
            , true
        );
        Log::info('Signature::request', [
            'config' => $this->config,
            'params' => $params,
            'response' => $response
        ]);
        $this->setError($response->Message);
        return $response->Code === 'OK' ? [
            'biz_id' => $response->BizId
        ] : false;
    }

    public function querySendDetails($bizId, $phoneNumber, $sendDate)
    {
        $params = [];
        $params['CurrentPage'] = 1;
        $params['PageSize'] = 1;

        // *** 需用户填写部分 ***
        // 必填: 短信接收号码
        $params["PhoneNumber"] = $phoneNumber;

        // 必填: 短信发送日期
        $params["SendDate"] = $sendDate;

        // 必填: 发送回执
        $params["BizId"] = $bizId;

        // 初始化SignatureHelper实例用于设置参数，签名以及发送请求
        $helper = new SignatureHelper;

        // 此处可能会抛出异常，注意catch
        $response = $helper->request(
            $this->config['AccessKeyId']
            , $this->config['AccessKeySecret']
            , "dysmsapi.aliyuncs.com"
            , array_merge($params, [
                "RegionId" => "cn-hangzhou",
                "Action" => "QuerySendDetails",
                "Version" => "2017-05-25",
            ])
            // 选填: 启用https
            , true
        );
        // 记录日志
        Log::info('Signature::request', [
            'config' => $this->config,
            'params' => $params,
            'response' => $response
        ]);
        $this->setError($response->Message);
        if ($response->Code === 'OK' && !empty($response->SmsSendDetailDTOs->SmsSendDetailDTO[0])) {
            $resData = $response->SmsSendDetailDTOs->SmsSendDetailDTO[0];
            return $resData->SendStatus > 1 ? [
                'is_received' => $this->formatReceivedStatus($resData->SendStatus),
                'received_time' => $resData->SendStatus == 3 ? strtotime($resData->ReceiveDate) : 0,
                'remark' => ErrorCode::$data[$resData->ErrCode] ?? ''
            ] : false;
        }
        return false;
    }

    public function addTemplate($msgType, $templateName, $templateContent)
    {
        $params = [];
        // *** 需用户填写部分 ***

        // 必填: 短信类型。其中：0：验证码。1：短信通知。2：推广短信。3：国际/港澳台消息。
        $params["TemplateType"] = $this->config[$msgType]['template_type'];

        // 必填：模板名称，长度为1~30个字符。
        $params["TemplateName"] = $templateName;

        // 必填：模板内容，长度为1~500个字符。
        $params["TemplateContent"] = $templateContent;

        // 必填：短信模板申请说明。
        $params['Remark'] = $this->config[$msgType]['remark'];

        // 初始化SignatureHelper实例用于设置参数，签名以及发送请求
        $helper = new SignatureHelper;

        // 此处可能会抛出异常，注意catch
        $response = $helper->request(
            $this->config['AccessKeyId']
            , $this->config['AccessKeySecret']
            , "dysmsapi.aliyuncs.com"
            , array_merge($params, [
                "RegionId" => "cn-hangzhou",
                "Action" => "AddSmsTemplate",
                "Version" => "2017-05-25",
            ])
            // 选填: 启用https
            , true
        );
        // 记录日志
        Log::info('Signature::request', [
            'config' => $this->config,
            'params' => $params,
            'response' => $response
        ]);
        $this->setError($response->Message);
        return $response->Code === 'OK' ? [
            'template_code' => $response->TemplateCode
        ] : false;
    }

    public function editTemplate($msgType, $templateName, $templateContent)
    {
        $params = [];
        // *** 需用户填写部分 ***

        // 必填：短信模板CODE。
        $params['TemplateCode'] = $this->config[$msgType]['template_code'];

        // 必填: 短信类型。其中：0：验证码。1：短信通知。2：推广短信。3：国际/港澳台消息。
        $params["TemplateType"] = $this->config[$msgType]['template_type'];

        // 必填：模板名称，长度为1~30个字符。
        $params["TemplateName"] = $templateName;

        // 必填：模板内容，长度为1~500个字符。
        $params["TemplateContent"] = $templateContent;

        // 必填：短信模板申请说明。
        $params['Remark'] = $this->config[$msgType]['remark'];

        // 初始化SignatureHelper实例用于设置参数，签名以及发送请求
        $helper = new SignatureHelper;

        // 此处可能会抛出异常，注意catch
        $response = $helper->request(
            $this->config['AccessKeyId']
            , $this->config['AccessKeySecret']
            , "dysmsapi.aliyuncs.com"
            , array_merge($params, [
                "RegionId" => "cn-hangzhou",
                "Action" => "ModifySmsTemplate",
                "Version" => "2017-05-25",
            ])
            // 选填: 启用https
            , true
        );
        // 记录日志
        Log::info('Signature::request', [
            'config' => $this->config,
            'params' => $params,
            'response' => $response
        ]);
        $this->setError($response->Message);
        return $response->Code === 'OK';
    }

    public function deleteTemplate($templateCode)
    {
        $params = [];
        // *** 需用户填写部分 ***

        // 必填：短信模板CODE。
        $params['TemplateCode'] = $templateCode;

        // 初始化SignatureHelper实例用于设置参数，签名以及发送请求
        $helper = new SignatureHelper;

        // 此处可能会抛出异常，注意catch
        $response = $helper->request(
            $this->config['AccessKeyId']
            , $this->config['AccessKeySecret']
            , "dysmsapi.aliyuncs.com"
            , array_merge($params, [
                "RegionId" => "cn-hangzhou",
                "Action" => "DeleteSmsTemplate",
                "Version" => "2017-05-25",
            ])
            // 选填: 启用https
            , true
        );
        // 记录日志
        Log::info('Signature::request', [
            'config' => $this->config,
            'params' => $params,
            'response' => $response
        ]);
        $this->setError($response->Message);
        return $response->Code === 'OK';
    }

    public function queryTemplate($templateCode)
    {
        $params = [];
        // *** 需用户填写部分 ***

        // 必填：短信模板CODE。
        $params['TemplateCode'] = $templateCode;

        // 初始化SignatureHelper实例用于设置参数，签名以及发送请求
        $helper = new SignatureHelper;

        // 此处可能会抛出异常，注意catch
        $response = $helper->request(
            $this->config['AccessKeyId']
            , $this->config['AccessKeySecret']
            , "dysmsapi.aliyuncs.com"
            , array_merge($params, [
                "RegionId" => "cn-hangzhou",
                "Action" => "QuerySmsTemplate",
                "Version" => "2017-05-25",
            ])
            // 选填: 启用https
            , true
        );
        // 记录日志
        Log::info('Signature::request', [
            'config' => $this->config,
            'params' => $params,
            'response' => $response
        ]);
        $this->setError($response->Message);
        return $response->Code === 'OK' ? [
            'template_code' => $response->TemplateCode,
            'audit_status' => $this->formatTemplateStatus($response->TemplateStatus),
            'remark' => $response->Reason,
        ] : false;
    }

    protected function formatTemplateStatus($status) {
        switch($status) {
            case 0: return Server::TEMPLATE_STATUS_AUDITING;
            case 1: return Server::RECEIVE_STATUS_SUCCESS;
            case 2: return Server::TEMPLATE_STATUS_FAIL;
            default: return 0;
        }
    }

    protected function formatReceivedStatus($status) {
        switch ($status) {
            case 1: return Server::RECEIVE_STATUS_WAITING;
            case 2: return Server::RECEIVE_STATUS_FAIL;
            case 3: return Server::RECEIVE_STATUS_SUCCESS;
        }
    }
}
