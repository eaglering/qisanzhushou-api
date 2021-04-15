<?php
declare(strict_types=1);

namespace app\core\driver\mail\engine;

use app\core\logic\Logic;

abstract class Server extends Logic
{
    /**
     * 发送普通文本邮件
     *
     * @param String $to      收件人
     * @param String $subject 主题
     * @param String $content 内容
     */
    abstract public function sendSimpleMail(String $to, String $subject, String $content);
    /**
     * 发送HTML邮件
     *
     * @param String to      收件人
     * @param String $subject 主题
     * @param String $content 内容（可以包含<html>等标签）
     */
    abstract public function sendHtmlMail(String $to, String $subject, String $content);

    /**
     * 发送带附件的邮件
     *
     * @param String $to 收件人
     * @param String $subject 主题
     * @param String $content 内容
     * @param array $files
     */
    abstract public function sendAttachmentMail(String $to, String $subject, String $content, array $files);
}
