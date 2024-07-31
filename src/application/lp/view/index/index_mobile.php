<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!--
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    -->
    <title><?=systemSetting('general_site_title')?>-合伙人</title>
    <link rel='shortcut icon' href='/static/favicon.ico' />
    <script type="text/javascript">
        var SITE_URL = '<?=SITE_URL?>';
        var STATIC_VER = '<?=STATIC_VER?>';
    </script>
    <link rel="stylesheet" type="text/css" href="/static/js/easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="/static/js/easyui/themes/mobile.css">
    <link rel="stylesheet" type="text/css" href="/static/js/easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="/static/js/easyui/themes/color.css">
    <link rel="stylesheet" type="text/css" href="/static/css/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="/static/bootstrap/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/static/css/mobile.css?<?=STATIC_VER?>"/>
    <link rel="stylesheet" type="text/css" href="/static/css/sb-admin-2.css?<?=STATIC_VER?>"/>
    <script type="text/javascript" src="/static/js/easyui/jquery.min.js"></script>
    <script type="text/javascript" src="/static/js/easyui/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="/static/js/easyui/jquery.easyui.mobile.js"></script>
    <script type="text/javascript" src="/static/js/easyui/locale/easyui-lang-zh_CN.js"></script>
    <script type="text/javascript" src="/static/highcharts/code/highcharts.js"></script>
    <script type="text/javascript" src="/static/js/pdfobject.js"></script>
</head>

<body>
<div class="easyui-navpanel">
    <header>
        <div class="m-toolbar">
            <div class="m-title"><?=systemSetting('general_site_title')?></div>
            <div class="m-right">
                <a href="javascript:void(0)" class="easyui-menubutton" data-options="iconCls:'fa fa-user-circle',menu:'#user-menus'">
                    <?=$_lp['name']?>
                </a>
                <div id="user-menus" class="easyui-menu">
                    <div data-options="iconCls:'fa fa-sign-out'" onclick="mApp.logout()">登出</div>
                </div>
            </div>
        </div>
    </header>

    <div id="m-content" class="easyui-navpanel" data-options="
        title:'<?=$menus[0]['title']?>',
        href:'<?=$menus[0]['url']?>',
        fit:true"></div>

    <footer>
        <div class="m-buttongroup m-buttongroup-justified" style="width:100%">
            <?php foreach ($menus as $k=>$v): ?>
            <a href="javascript:void(0)" class="easyui-linkbutton" data-options="
               iconCls:'fa <?=$v['icon']?> fa-2x',
               size:'large',
               iconAlign:'top',
               toggle:true,
               selected:<?=$k?'false':'true'?>,
               group:'footer-nav',
               plain:true" onclick="mApp.open('<?=$v['title']?>','<?=$v['url']?>')"><?=$v['name']?></a>
            <?php endforeach; ?>
        </div>
    </footer>
</div>

<div id="p2" class="easyui-navpanel">
    <header>
        <div class="m-toolbar">
            <div id="m-title-p2" class="m-title"></div>
            <div class="m-left">
                <a href="#" class="easyui-linkbutton m-back" data-options="plain:true,back:true">后退</a>
            </div>
        </div>
    </header>
    <div id="m-content-p2" class="easyui-navpanel" data-options="title:''"></div>
</div>

<div id="globel-dialog-div" class="word-wrap" style="line-height:1.5"></div>
<script type="text/javascript" src="/static/js/jquery.json.min.js"></script>
<script type="text/javascript" src="/static/bootstrap/popper.min.js"></script>
<script type="text/javascript" src="/static/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript">
var mApp = {
    dialog: '#globel-dialog-div',
    init:function(){
        //mApp.updateCss();
    },
    go:function(title,url){
        $('#m-title-p2').text(title);
        $('#m-content-p2').panel('refresh',url);
        $.mobile.go('#p2');
    },
    open:function(title,url){
        if (!url) {
            return false;
        }
        $('#m-content').panel('setTitle',title).panel('refresh',url);
    },
    view:function(options){
        $(mApp.dialog).dialog({
            title: options.title,
            width: "95%",
            height: '90%',
            href: options.url,
            modal: true,
            border:false,
            buttons:[{
                text:'关闭',
                iconCls:'fa fa-close',
                handler: function(){
                    $(mApp.dialog).dialog('close');
                }
            }]
        });
        $(mApp.dialog).dialog('center');
    },
    updateCss:function(){
        //$('#m-content').prev().css({background:'#EFF5FF ',paddingLeft:'10px'}).children('.panel-title').css({fontWeight:'normal',color:'#666'});
    },
    //退出登录
    logout:function(){
        $.messager.confirm('提示信息', '确定退出登录吗？', function(y){
            if (!y) {
                return;
            }
            $.messager.progress({text:'处理中，请稍候...'});
            $.post('<?=url('index/logout')?>', function(data){
                $.messager.progress('close');
                if(data.code){
                    window.location.href = data.data;
                }
            });
        });
    }
};
$(function(){
    mApp.init();
});
$(document).ajaxError(function (event, XMLHttpRequest, ajaxOptions){
	switch (XMLHttpRequest.status) {
		case 401: // Unauthorized
			// Take action, referencing XMLHttpRequest.responseText as needed.
			window.location.assign('<?=url('lp/Index/login')?>');
			return false;
			break;
	}
});
</script>
</body>
</html>