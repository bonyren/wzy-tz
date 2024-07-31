<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="author" content="wzycoding@qq.com">
<title><?=systemSetting('general_site_title')?></title>
<meta name="keywords" content="<?=systemSetting('general_site_keywords')?>">
<meta name="description" content="<?=systemSetting('general_site_description')?>">
<title><?=systemSetting('general_site_title')?></title>
<?php include(APP_PATH . 'lp' . DS . 'view' . DS . 'common/head.php'); ?>
</head>
<body class="easyui-layout">

<!-- 头部 -->
<div id="toparea" data-options="region:'north',border:false,height:48">
	<div id="topmenu" class="easyui-panel" data-options="fit:true,border:false">
		<ul class="nav">
			<li class="logo"><img src="<?=systemSetting('general_organisation_logo')?>" height="40" /></li>
			<li><h2><?=systemSetting('general_site_title')?></h2></li>
		</ul>
		<ul class="nav-right">
			<li>
				<a href="javascript:;" onclick="baseModule.openUrl({'url':'<?=$home_page?>'})"
                   class="easyui-linkbutton" data-options="plain:true,iconCls:'fa fa-home'">首页</a>
                <a href="javascript:;" class="easyui-splitbutton" data-options="menu:'#toparea-user-info-box',
                	iconCls:'fa fa-user-circle'"><?=$_lp['name']?></a>
				<div id="toparea-user-info-box">
					<div data-options="iconCls:'fa fa-sign-out'" onclick="baseModule.logout()">登出</div>
				</div>
				<a href="javascript:;" class="easyui-splitbutton" data-options="menu:'#toparea-help-box',
					iconCls:'fa fa-question-circle'">帮助
				</a>
				<div id="toparea-help-box">
					<div data-options="iconCls:'fa fa-paper-plane'" onclick="$.messager.alert('Feedback', 'Please send email to <a href=mailto:wzycoding@qq.com>wzycoding@qq.com</a> thanks!', 'info');">反馈
				</div>
			</li>
		</ul>
		<div style="clear:both;border-bottom:none;border-left:none;border-right:none"></div>
	</div>
</div>

<!-- 左侧菜单 -->
<!--
<div id="leftarea" data-options="iconCls:'icons-energy-navigation',
	region:'west',
	title:'导航',
	split:true,
	width:'18%'">
	<div id="leftmenu" class="easyui-accordion" data-options="fit:true,border:false"></div>
</div>
-->

<!-- 内容 -->
<div id="mainarea" data-options="region:'center',split:true,href:'<?=$home_page?>',title:'首页',iconCls:'fa fa-home'"></div>

<!-- 公共部分 -->
<div id="globel-dialog-div" class="word-wrap" style="line-height:1.5"></div>
<div id="globel-dialog2-div" class="word-wrap" style="line-height:1.5"></div> <!-- 特殊情况可能需要弹出第2个弹出层 -->
<div id="globel-dialog3-div" class="word-wrap" style="line-height:1.5"></div> <!-- 特殊情况可能需要弹出第3个弹出层 -->
<div id="dialog-uuid-replace"></div>
<?php include(APP_PATH . 'lp' . DS . 'view' . DS . 'common/foot.php'); ?>
<script type="text/javascript">
window.baseModule = {
	dialog: '#globel-dialog-div',
	dialog2: '#globel-dialog2-div',
	leftNav: '#leftnav',
	//初始化
	init: function(){
		// this.loadLeft();
	},
	//load the command menu according to the user
	loadLeft: function(){
		var that = this;
		//开始获取左侧栏目
		$.ajax({
			type: 'POST',
			url: "<?=url('index/loadMenu')?>",
			data: {},
			cache: false,
			beforeSend: function(){
				that.removeLeft();
				//更新标题名称
				var loading = '<div class="panel-loading">Loading...</div>';
				$("#leftmenu").accordion("add", {content: loading});
			},
			success: function(data){
				that.removeLeft();
				//左侧内容更新
				$.each(data, function(i, menu) {
					var content = '';
					if(menu.children){
						var treedata = $.toJSON(menu.children);
						content = '<ul class="easyui-tree" data-options=\'data:' + treedata + ',animate:true,lines:true,onClick:function(node){baseModule.openUrl(node)}\'></ul>';
					}
					$("#leftmenu").accordion("add", {title: menu.name, content: content, iconCls: menu.iconCls, selected:false});
				});
				$("#leftmenu").accordion("select", 0);
			}
		});
		//如果左侧隐藏则进行展开
		if($('body').layout('panel', 'west').panel("options").collapsed){
			$('body').layout('expand', 'west');
		}
	},
	//移除左侧栏目,remove twice
	removeLeft: function(stop, titles){
		var pp = $("#leftmenu").accordion("panels");
		$.each(pp, function(i, p) {
			if(p){
				var t = p.panel("options").title;
				if(titles && titles.length){
					for(var k = 0; k < titles.length; k++){
						if(titles[k] == t) $("#leftmenu").accordion("remove", t);
					}
				}else{
					$("#leftmenu").accordion("remove", t);
				}
			}
		});
		var p = $('#leftmenu').accordion('getSelected');
		if(p) {
			var t = p.panel('options').title;
			if(titles && titles.length){
				for(var k = 0; k < titles.length; k++){
					if(titles[k] == t) $("#leftmenu").accordion("remove", t);
				}
			}else{
				$("#leftmenu").accordion("remove", t);
			}
		}
		if(!stop){
			this.removeLeft(true, titles);
		}
	},
	//显示打开内容
	openUrl: function(node){
		if (undefined === node.url) {
			return false;
		}
		/*the following can work well, but can't change the panel icon dynamically
		$('#mainarea').panel('setTitle', node.attributes.breadcrumb);
		$('#mainarea').panel('refresh', node.url);
		*/
		$('#mainarea').panel({
			title: node.attributes ? node.attributes.breadcrumb : '首页',
			href: node.url,
			iconCls: node.iconCls ? node.iconCls : ''
		})
	},
	//退出登录
	logout: function(){
		$.messager.confirm('提示信息', '确定要退出登录吗？', function(y){
		    if (!y) {
		        return;
            }
			$.messager.progress({text:'处理中，请稍候...'});
			$.post('<?=url('lp/index/logout')?>', function(data){
				$.messager.progress('close');
				if(data.code){
					window.location.href = data.data;
				}
			});
		});
	},
	help: function(topicId){
		var that = this;
		var href = '<?=url('index/Help/help')?>';
		href += href.indexOf('?') != -1 ? '&topicId=' + topicId : '?topicId='+topicId;
		$(that.dialog2).dialog({
			title: '帮助',
			iconCls: 'fa fa-question-circle-o',
			width: '60%',
			height: '100%',
			cache: false,
			href: href,
			modal: true,
			collapsible: false,
			minimizable: false,
			resizable: false,
			maximizable: false,
			buttons:[
				{
					text:'关闭',
					iconCls:iconClsDefs.cancel,
					handler: function(){
						$(that.dialog2).dialog('close');
					}
				}]
		});
		$(that.dialog2).dialog('center');
		return false;
	}
};
$(function(){
	baseModule.init();
	$.extend($.fn.validatebox.defaults.rules, {
		mobile: {
			validator:function(value,param){
				var re = /^1[23456789]\d{9}$/;
				if(re.test(value)){
					return true;
				}else{
					return false;
				}
			},
			message:'请填写正确格式的手机号码'
		},
		domain:{
			validator:function(value,param){
				var re = /^[a-zA-Z0-9][-a-zA-Z0-9]{0,62}(\.[a-zA-Z0-9][-a-zA-Z0-9]{0,62})+$/;
				if(re.test(value)){
					return true;
				}else{
					return false;
				}
			},
			message:'请填写正确的域名格式'
		},
        date: {
            validator: function(value){
                var regex = /^\d{4}-\d{1,2}-\d{1,2}$/;
                return regex.test(value);
            },
            message: '请按如下格式填写日期：2017-01-01'
        },
        greater: {
            validator:function(value,param){
                if(value-$(param[0]).val() >= 0){
                    return true;
                }else{
                    return false;
                }
            },
            message:'数值过小'
        },
        lesser: {
            validator:function(value,param){
                if(value-$(param[0]).val() <= 0){
                    return true;
                }else{
                    return false;
                }
            },
            message:'数值过大'
        }
	});
});
var DG_ROW_CSS = {
    rowGray: 'color:#999;background-color:#F3F3F3;',
    rowWarn: 'color:#FF0000;background:#FFB90F;',
    rowError: 'color:#FF0000;background:#FFF8DC;',
    rowDel: 'text-decoration:line-through;background:#A1A1A1;'
};
GLOBAL.namespace('config');
GLOBAL.config.upload = <?=json_encode(config('upload'))?>;

function getEasyuiComponentType(target){
	var plugins = $.parser.plugins;
	for(var i=plugins.length-1; i>=0; i--){
		if ($(target).data(plugins[i])){
			return plugins[i];
		}
	}
	return null;
}
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