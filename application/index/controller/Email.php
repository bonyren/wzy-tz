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
namespace app\index\controller;
require_once SITE_DIR .'/../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class Email extends Common
{
    public function test(){

    }

    public function send($tpl,$recipients,$data=[])
    {
        $conf = config('mailer');
        $mail = new PHPMailer();
        $parse = $this->parse($tpl,$data);
        if(!is_array($recipients)){
            $recipients = explode(',', $recipients);
        }
        try{
            $mail->CharSet ="UTF-8";                     //设定邮件编码
            $mail->SMTPDebug = 0;                        // 调试模式输出
            $mail->isSMTP();                             // 使用SMTP
            $mail->Host = $conf['smtp'];                // SMTP服务器
            $mail->SMTPAuth = true;                      // 允许 SMTP 认证
            $mail->Username = $conf['username'];                // SMTP 用户名  即邮箱的用户名
            $mail->Password = $conf['password'];             // SMTP 密码  部分邮箱是授权码(例如163邮箱)
            $mail->SMTPSecure = 'ssl';                    // 允许 TLS 或者ssl协议
            $mail->Port = 465;                            // 服务器端口 25 或者465 具体要看邮箱服务器支持

            $mail->setFrom($conf['from_address'], $conf['from_name']);  //发件人
            foreach ($recipients as $to_address) {
                $mail->addAddress($to_address);  // 收件人
            }
            //Content
            $mail->isHTML(true);                                  // 是否以HTML文档格式发送  发送后客户端可直接显示对应HTML内容
            $mail->Subject = $parse['subject'];
            $mail->Body    = $parse['body'];
//            $mail->AltBody = '如果邮件客户端不支持HTML则显示此内容';
            $mail->send();
            return true;
        }catch(Exception $e){
            return $mail->ErrorInfo;
        }
    }

    public function parse($tpl,$data=[]){
        $this->assign('bind',$data);
        $json = $this->fetch('email/tpl_'.$tpl);
        return json_decode($json,true);
    }

}