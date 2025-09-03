<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title><?=systemSetting('general_site_title')?> - 项目端</title>
    <link rel='shortcut icon' href='/static/favicon.ico' />

    <link rel="stylesheet" type="text/css" href="/static/css/icons.css?<?=STATIC_VER?>" />
    <link rel="stylesheet" type="text/css" href="/static/css/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="/static/js/easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="/static/bootstrap/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/static/css/index/default.css?<?=STATIC_VER?>"/>
    <link rel="stylesheet" type="text/css" href="/static/css/components.css?<?=STATIC_VER?>"/>

    <script type="text/javascript" src="/static/js/easyui/jquery.min.js"></script>
    <script type="text/javascript" src="/static/js/easyui/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="/static/js/easyui/locale/easyui-lang-zh_CN.js"></script>
    <script type="text/javascript" src="/static/js/easyui/extension/jquery-easyui-datagridview/datagrid-detailview.js?<?=STATIC_VER?>"></script>
    <script type="text/javascript" src="/static/js/jquery.app.js?<?=STATIC_VER?>"></script>
    <script type="text/javascript" src="/static/js/common.js?<?=STATIC_VER?>"></script>
    <script type="text/javascript" src="/static/js/components.js?<?=STATIC_VER?>"></script>
    <style type="text/css">
        .main-header .panel-title {text-align: center;font-size: 16px;}
    </style>
    <script type="text/javascript">
var SITE_URL='<?=SITE_URL?>';var iconClsDefs=<?=json_encode(\app\index\logic\Defs::$iconClsDefs,true)?>;</script>
</head>

<body class="easyui-layout">

<div id="toparea" data-options="region:'north',border:false,height:48">
    <div id="topmenu" class="easyui-panel" data-options="fit:true,border:false">
        <ul class="nav">
            <li class="logo">
                <img src="<?=systemSetting('general_organisation_logo')?>" height="40" />
            </li>
            <li><h4><?=systemSetting('general_site_title')?></h4></li>
        </ul>
        <ul class="nav-right">
            <li>
                <a href="javascript:void(0);" class="easyui-splitbutton" data-options="menu:'#toparea-user-info-box',iconCls:'fa fa-user-circle'">
                    <?=$_user['name']?>
                </a>
                <div id="toparea-user-info-box">
                    <div data-options="iconCls:'fa fa-key'" onclick="root.password()">修改密码</div>
                    <div class="menu-sep"></div>
                    <div data-options="iconCls:'fa fa-sign-out'" onclick="root.logout()">登出</div>
                </div>
                <?php
                if(!request()->isMobile()){
                ?>
                    <a href="javascript:void(0);" class="easyui-splitbutton" data-options="menu:'#toparea-help-box',iconCls:'fa fa-question-circle'">帮助</a>
                    <div id="toparea-help-box">
                        <div data-options="iconCls:'fa fa-paper-plane'" onclick="$.messager.alert('Feedback', 'Please send email to <a href=mailto:wzycoding@qq.com>wzycoding@qq.com</a> thanks!', 'info');">反馈
                    </div>
                <?php
                }
                ?>
            </li>
        </ul>
        <div style="clear:both;border-bottom:none;border-left:none;border-right:none"></div>
    </div>
</div>

<!-- 内容 -->
<div id="mainarea" data-options="region:'center',headerCls:'main-header',title:'<?=$enterprise['name']?>'">
    <div class="easyui-tabs" data-options="fit:true,border:false,tabPosition:'top'">
        <div title="会议材料" data-options="
            href:'<?=$urls['meeting']?>',
            iconCls:'fa fa-files-o'"></div>
        <div title="财务报告" data-options="
            href:'<?=$urls['finance']?>',
            iconCls:'fa fa-file-excel-o'"></div>
        <div title="进展描述" data-options="
            href:'<?=$urls['progress']?>',
            iconCls:'fa fa-flag-o'"></div>
    </div>
</div>

<div id="dialog-uuid-replace"></div>
<script type="text/javascript">
GLOBAL.namespace('config');GLOBAL.config.upload=<?=json_encode(config('upload'))?>;var root={dialog:'#globel-dialog-div',open:function(title,url){if(!url){return false;}
$('#m-content').panel('setTitle',title).panel('refresh',url);},view:function(options){$(mApp.dialog).dialog({title:options.title,width:"95%",height:'90%',href:options.url,modal:true,border:false,buttons:[{text:'关闭',iconCls:'fa fa-close',handler:function(){$(mApp.dialog).dialog('close');}}]});$(mApp.dialog).dialog('center');},logout:function(){$.messager.confirm('提示信息','确定退出登录吗？',function(y){if(!y){return;}
$.messager.progress({text:'处理中，请稍候...'});$.post('<?=url('index/logout')?>',function(data){$.messager.progress('close');if(data.code){window.location.href=data.data;}});});},password:function(){var that=this;var href='<?=url('index/password')?>';QT.helper.dialog('修改密码',href,true,function($dialog){var $form=$('#my-password-form');if(!$form.form('validate')){return false;}
$.messager.progress({text:'处理中，请稍候...'});$.post(href,$form.serialize(),function(res){$.messager.progress('close');if(!res.code){$.app.method.alertError(null,res.msg);}else{$.app.method.tip('提示',res.msg);$dialog.dialog('close');}},'json');},520,260);}};$(document).ajaxError(function(event,XMLHttpRequest,ajaxOptions){switch(XMLHttpRequest.status){case 401:window.location.assign('<?=url('p/Index/login')?>');break;case 400:$.app.method.alertError(null,"错误的请求");if(ajaxOptions.type=='POST'){$.messager.progress('close');}
break;case 404:$.app.method.alertError(null,"资源不存在或已经删除");if(ajaxOptions.type=='POST'){$.messager.progress('close');}
break;case 500:$.app.method.alertError(null,"系统内部错误，请联系管理员(wzycoding@qq.com)");if(ajaxOptions.type=='POST'){$.messager.progress('close');}
break;}});</script>
</body>
</html>