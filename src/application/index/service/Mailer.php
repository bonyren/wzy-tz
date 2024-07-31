<?php
// +----------------------------------------------------------------------
// | WZYCODING [ SIMPLE SOFTWARE IS THE BEST ]
// +----------------------------------------------------------------------
// | Copyright (c) 2018~2025 wzycoding All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://license.coscl.org.cn/MulanPSL2 )
// +----------------------------------------------------------------------
// | Author: wzycoding <wzycoding@qq.com>
// +----------------------------------------------------------------------
namespace app\index\service;
use PHPMailer\PHPMailer\PHPMailer;
class Mailer extends Base
{
    protected $config = [
        'EMAIL_SMTP' => '',
        'EMAIL_PORT' => 25,
        'EMAIL_USER' => '',
        'EMAIL_PWD' => '',
        'EMAIL_FROM_ADDRESS' => '',
        'EMAIL_FROM_NAME' => '',
    ];
    public $isHtml = false;

    protected function __construct() {
        $this->config = array_merge($this->config, Setting::I()->collection('email'));
    }

    public function isHtml($value=null) {
        if (is_bool($value)) {
            $this->isHtml = $value;
        }
        return $this->isHtml;
    }

    public function send($to, $subject, $content){
        if(empty($to)){
            return false;
        }
        foreach ($this->config as $k=>$v) {
            if (empty($v)) {
                return false;
            }
        }
        $phpMailer = new PHPMailer(null);

        $phpMailer->SingleTo = false;
        $phpMailer->CharSet = 'UTF-8';
        $phpMailer->SMTPDebug = 0;
        $phpMailer->Debugoutput = 'html';
        //initialize the smtp configuration
        $phpMailer->Host = $this->config['EMAIL_SMTP'];
        $phpMailer->Port = $this->config['EMAIL_PORT'];
        $phpMailer->Username = $this->config['EMAIL_USER'];
        $phpMailer->Password = $this->config['EMAIL_PWD'];
        $phpMailer->SMTPAuth = true;
        $phpMailer->SMTPSecure = '';
        $phpMailer->SMTPAutoTLS = false;
        $phpMailer->Mailer = 'smtp';
        $phpMailer->Sender = $this->config['EMAIL_USER'];
        $phpMailer->SetFrom($this->config['EMAIL_FROM_ADDRESS'], $this->config['EMAIL_FROM_NAME']);
        $phpMailer->SMTPOptions = [];
        $phpMailer->Subject = $subject;
        $phpMailer->Body = $content;
        $phpMailer->isHTML($this->isHtml);
        $phpMailer->addAddress($to);
        $result = $phpMailer->send();
        if(!$result){
            $mailError = $phpMailer->ErrorInfo;
        }
        return $result;
    }
}