<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?=systemSetting('general_site_title')?> - lp端</title>
    <link rel='shortcut icon' href='/static/favicon.ico' />
    <script type="text/javascript">
var SITE_URL='<?=SITE_URL?>';var STATIC_VER='<?=STATIC_VER?>';</script>
    <link rel="stylesheet" type="text/css" href="/static/css/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="/static/bootstrap/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="/static/css/mobile.css?<?=STATIC_VER?>"/>
    <script type="text/javascript" src="/static/js/easyui/jquery.min.js"></script>
    <style>
        /**, ::after, ::before {box-sizing: border-box;}*/
        body{
            background:url('/static/img/login_backgroud.png?<?=STATIC_VER?>') no-repeat fixed top;
            background-position: 0% 0%;
            background-size: 100% 100%;
        }
        .t3-header {
            margin: 0 auto;
            padding: 22px 0;
        }
        .img-responsive{
            max-width: 100%;
            display: inline-block;
            height: 40px;
        }
        .footer {
            position:fixed;
            opacity: 0.6;
            bottom: 1em;
            width: 100%;
            display: table-cell;
            vertical-align: middle;
            text-align: center;
            /*line-height: 5.5em;*/
            color: #fff;
			z-index: -1;
        }
        .footer h1{
            margin-bottom: 1rem;
            font-size: 1.5em;
            line-height: 1.5;
            letter-spacing: 0.2em;
            text-indent: 0.2em;
            font-weight: 500;
        }
        .footer h2{
            font-size: 1rem;
            letter-spacing: 0.2em;
            text-indent: 0.2em;
            font-weight: 200;
        }
        .content-center {
            margin-left: auto;
            margin-right: auto;
            padding: 0 2.2em;
            color: #FFFFFF;
            width: 100%;
            max-width: 480px;
            background-color: #000080;
        }
        .login-form{
            margin-top: 1rem;
            font-size: 1.5em;
        }
        .login-form .headline{
            background-color: #065eba;
        }
        .login-page .login-form .form-group .form-control {
            background-color: rgba(255, 255, 255, 0.1);
            color: #FFFFFF;
            font-size: 1em;
        }
        .login-page .login-form .form-group .btn{font-size: 1em}
        .forget-pass{font-size:initial}
    </style>
</head>

<body class="login-page">
<header id="t3-header" class="t3-header clearfix">
    <!-- LOGO -->
    <div class="pull-left">
        <div class="logo-image">
            <img class="img-responsive" src="/static/img/logo_white2x.png" alt="<?=systemSetting('general_site_title')?>">
        </div>
    </div>
    <!-- //LOGO -->
</header>
<div class="container">
    <div class="row">
        <div class="col-sm-4 content-center">
            <form class="login-form">
                <div class="form-group text-center headline">
                    <label>LP登录端</label>
                </div>
                <div class="form-group">
                    <label for="login_account">手机号码</label>
                    <input name="phone" type="text" class="form-control" id="login_account" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label for="login_password">登录密码</label>
                    <input name="password" type="password" class="form-control" id="login_password" autocomplete="off" required>
                </div>
                <div class="form-group text-center" style="margin-top:1.5em">
                    <button id="login-btn" class="btn btn-primary btn-block" type="submit">
                        登&nbsp;&nbsp;录
                    </button>
                </div>
                <div class="form-group text-right">
                    <label class="form-check-label forget-pass">忘记密码?</label>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="footer">
    <h1 class="title fadeInUp wf">

    </h1>
    <h2 class="title fadeInUp wf">

    </h2>
</div>

<script type="text/javascript">
var locked=false;$('.login-form').submit(function(){if(locked){return false;}
if(''===$.trim($('#login_account').val())){$('#login_account').focus();return false;}
if(''===$.trim($('#login_password').val())){$('#login_password').focus();return false;}
locked=true;$('#login-btn').prop('disabled',true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Loading...');$.post('<?=url('lp/index/login')?>',$(this).serialize(),function(res){if(res.code){window.location.href=res.data;}else{alert(res.msg);locked=false;$('#login-btn').prop('disabled',false).html('登&nbsp;&nbsp;录');}},'json');return false;});</script>
</body>
</html>