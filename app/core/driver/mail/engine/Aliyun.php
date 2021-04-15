<?php
declare(strict_types=1);

namespace app\core\driver\mail\engine;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use think\facade\Log;

class Aliyun extends Server
{
    private $config;
    private $mail;
    /**
     * 构造方法
     * ```php
     * 'host' => 'smtpdm.aliyun.com',
     * 'port' => 25,
     * 'username' => '',
     * 'password' => '',
     * 'from' => '',
     * ```
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = $config;
        $this->mail = new PHPMailer(true);
        $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $this->mail->isSMTP();
        $this->mail->Host = $this->config['host'];
        $this->mail->SMTPAuth = true;
        $this->mail->Port = $this->config['port'];
        $this->mail->Username = $this->config['username'];
        $this->mail->Password = $this->config['password'];

        // Recipients
        $this->mail->setFrom($this->config['from']);
    }

    public function sendSimpleMail(string $to, string $subject, string $content)
    {
        try {
            $this->mail->addAddress($to);
            $this->mail->Subject = $subject;
            $this->mail->Body = $content;

            $this->mail->send();
            return true;
        } catch (Exception $e) {
            Log::error(pretty_exception($e));
            return false;
        }
    }

    public function sendHtmlMail(string $to, string $subject, string $content)
    {
        try {
            $this->mail->addAddress($to);

            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body = $content;

            $this->mail->send();
            return true;
        } catch (Exception $e) {
            Log::error(pretty_exception($e));
            return false;
        }
    }

    public function sendAttachmentMail(string $to, string $subject, string $content, array $files)
    {
        try {
            $this->mail->addAddress($to);

            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body = $content;
            foreach ($files as $filename => $filePath) {
                if (!is_string($filename)) {
                    $filename = '';
                }
                $this->mail->addAttachment($filePath, $filename);
            }

            $this->mail->send();
            return true;
        } catch (Exception $e) {
            Log::error(pretty_exception($e));
            return false;
        }
    }
}
