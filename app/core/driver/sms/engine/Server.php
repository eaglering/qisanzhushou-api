<?php

namespace app\core\driver\sms\engine;

use app\core\logic\Logic;

abstract class Server extends Logic
{
    const TEMPLATE_STATUS_AUDITING = 10;
    const TEMPLATE_STATUS_SUCCESS = 20;
    const TEMPLATE_STATUS_FAIL = 30;

    const RECEIVE_STATUS_WAITING = 10;
    const RECEIVE_STATUS_SUCCESS = 20;
    const RECEIVE_STATUS_FAIL = 30;

    abstract public function sendSms($msgType, $templateParams);

    abstract public function sendBatchSms($msgType, $templateParams);

    abstract public function querySendDetails($bizId, $phoneNumber, $sendDate);

    abstract public function addTemplate($msgType, $templateName, $templateContent);

    abstract public function editTemplate($msgType, $templateName, $templateContent);

    abstract public function deleteTemplate($templateCode);

    abstract public function queryTemplate($templateCode);
}
