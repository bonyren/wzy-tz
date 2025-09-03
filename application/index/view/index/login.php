<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?=systemSetting('general_site_title')?></title>
    <link rel='shortcut icon' href='/static/favicon.ico' />
    <script type="text/javascript">
var SITE_URL='<?=SITE_URL?>';var STATIC_VER='<?=STATIC_VER?>';</script>
    <link rel="stylesheet" type="text/css" href="/static/css/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="/static/bootstrap/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="/static/css/mobile.css?<?=STATIC_VER?>"/>
    <script type="text/javascript" src="/static/js/easyui/jquery.min.js"></script>
    <script type="text/javascript" src="/static/js/jquery.loading.min.js"></script>
    <style>
        html {
            height: 100%;
        }
        body{
            height: 100%;
            background:url('/static/img/login_backgroud.png?<?=STATIC_VER?>') no-repeat fixed top;
            background-position: 0% 0%;
            background-size: 100% 100%;
        }
        .img-responsive{
            max-width: 100%;
            display: inline-block;
            height: 40px;
        }
        .login-page .logo{
            position: absolute;
            left: 10px;
            top: 10px;
        }
        .login-page .copyright{
            position: fixed;
            bottom:0px;
            width:100%;
        }
        .login-page .content-center {
            margin-left: auto;
            margin-right: auto;
            padding: 0 2.2em;
            color: #FFFFFF;
            width: 100%;
            max-width: 480px;
            background-color: #000080;
        }
        .login-page .login-form{
            margin-top: 1rem;
            font-size: 1.5em;
        }
        .login-page .login-form .form-group .form-control {
            background-color: rgba(255, 255, 255, 0.1);
            color: #FFFFFF;
            font-size: 1em;
        }
        .login-page .login-form .form-group .btn{
            font-size: 1em;
        }
        img#login-captcha-img{
            border-radius: .25rem;
        }
        .form-check-label{
            font-size: 1rem;
        }
    </style>
</head>
<body class="login-page d-flex flex-column align-items-center justify-content-center">
<div class="logo">
    <img class="img-responsive" src="/static/img/logo_white2x.png" alt="<?=systemSetting('general_site_title')?>">
</div>
<div class="container">
    <div class="row">
        <div id="login-box" class="col-sm-6 content-center">
            <form class="login-form" action="<?=$urls['login']?>" method="post">
		        <div class="form-group text-center">
                    <h3><img src="<?=systemSetting('general_organisation_logo')?>" style="height: 32px;">&nbsp;<?=systemSetting('general_organisation_name')?></h3>
                </div>
                <div class="form-group">
                    <label for="login_account">用户名</label>
                    <input name="username" type="text" class="form-control" id="login_account" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="login_password">密码</label>
                    <input name="password" type="password" class="form-control" id="login_password" autocomplete="off" required>
                </div>
                <?php if($login_captcha_enable){ ?>
                    <div class="form-group" id="captcha_section">
                        <label for="login_captcha">验证码</label>
                        <div class="form-row">
                            <div class="col-md-8 mt-2">
                                <input name="captcha" type="text" class="form-control" id="login_captcha" autocomplete="off" required>
                            </div>
                            <div class="col-md-4 mt-2">
                                <img id="login-captcha-img" align="top" onclick="changeCode()" src="<?=$urls['captcha']?>" title="刷新验证码">
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="form-group form-check">
                    <input name="auto_login" type="checkbox"  id="auto_login" value="1" autocomplete="off">
                    <label class="form-check-label" for="auto_login">自动登录</label>
                </div>
                <div class="form-group text-center mt-1">
                    <button id="login-btn" class="btn btn-primary btn-block" type="submit">登&nbsp;&nbsp;录</button>
                </div>
        	</form>
            <div class="p-2" >
                测试账号, 用户名: <span class="text-primary">test</span> 密码: <span class="text-primary">123456</span><br />
                意向咨询，微信: <span class="text-primary">wzyer_com</span> 邮件: <a href="mailto:wzycoding@qq.com">wzycoding@qq.com</a>
            </div>
        </div>
    </div>
</div>
<div class="text-center mb-1 copyright">
    <span class="text-white"><?=systemSetting('general_power_by_text')?></span><a href="https://beian.miit.gov.cn" target="_blank" class="ml-3 text-white"><?=systemSetting('general_site_beian')?></a>
</div>

<script type="text/javascript">
function changeCode(){var that=document.getElementById('login-captcha-img');if(that){var src=that.src;src=src.replace(/&salt=[0-9.]+/,'');that.src=src+'&salt='+Math.random();}}
$(function(){$('#login_account').focus();$('.login-form').submit(function(){if(''===$.trim($('#login_account').val())){$('#login_account').focus();return false;}
if(''===$.trim($('#login_password').val())){$('#login_password').focus();return false;}
$('#login-btn').html('<i class="fa fa-circle-o-notch fa-spin"></i>');$('#login-btn').prop('disabled',true);$('#login-box').loading();return true;});$(document).keyup(function(event){if(event.keyCode==13){$('.login-form').submit();}});});</script>
</body>
</html>