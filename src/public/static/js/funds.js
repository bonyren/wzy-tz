/**
 * Created by Nan on 2019/9/30.
 */

var fundsCommonModule = {
    dialog:'#globel-dialog-div',
    add:function(href, callback){
        var that = this;
        $(that.dialog).dialog({
            title: '添加新基金',
            iconCls: 'fa fa-plus-circle',
            width: window.loginMobile?'90%':1000,
            height: '95%',
            cache: false,
            href: href,
            modal: true,
            collapsible: false,
            minimizable: false,
            resizable: false,
            maximizable: true,
            onClose: callback,
            buttons:[{
                text:'确定',
                iconCls:iconClsDefs.ok,
                handler: function(){
                    /*
                    $(that.dialog).find('form').eq(0).form('submit', {
                        onSubmit: function(){
                            var isValid = $(this).form('validate');
                            if (!isValid) return false;
                            $.messager.progress({text:'处理中，请稍候...'});
                            $.post(href, $(this).serialize(), function(res){
                                $.messager.progress('close');
                                if(!res.code){
                                    $.app.method.alertError(null, res.msg);
                                }else{
                                    $.app.method.tip('提示', res.msg, 'info');
                                    $(that.dialog).dialog('close');
                                }
                            }, 'json');
                            return false;
                        }
                    });*/
                    var $form = $(that.dialog).find('form').eq(0);
                    var isValid = $form.form('validate');
                    if (!isValid) return false;
                    $.messager.progress({text:'处理中，请稍候...'});
                    $.post(href, $form.serialize(), function(res){
                        $.messager.progress('close');
                        if(!res.code){
                            $.app.method.alertError(null, res.msg);
                        }else{
                            $.app.method.tip('提示', res.msg, 'info');
                            $(that.dialog).dialog('close');
                        }
                    }, 'json');
                }
            },{
                text:'取消',
                iconCls:iconClsDefs.cancel,
                handler: function(){
                    $(that.dialog).dialog('close');
                }
            }]
        });
        $(that.dialog).dialog('center');
    },
    edit:function(href, title, callback){
        var that = this;
        $(that.dialog).dialog({
            title: title,
            iconCls: 'fa fa-pencil-square',
            width: window.loginMobile?'90%':1000,
            height: '95%',
            cache: false,
            href: href,
            modal: true,
            collapsible: false,
            minimizable: false,
            resizable: false,
            maximizable: true,
            onClose: callback,
            buttons:[{
                text:'关闭',
                iconCls:iconClsDefs.cancel,
                handler: function(){
                    $(that.dialog).dialog('close');
                }
            }]
        });
        $(that.dialog).dialog('center');
    },
    delete:function(href, callback){
        var that = this;
        $.messager.progress({text:'处理中，请稍候...'});
        $.post(href, {}, function(res){
            $.messager.progress('close');
            if(!res.code){
                $.app.method.alertError(null, res.msg);
            }else{
                $.app.method.tip('提示', res.msg, 'info');
                callback();
            }
        }, 'json');
    },
    view:function(href, title){
        var that = this;
        $(that.dialog).dialog({
            title: title,
            iconCls: 'fa fa-eye',
            width: window.loginMobile?'90%':1000,
            height: '95%',
            cache: false,
            href: href,
            modal: true,
            collapsible: false,
            minimizable: false,
            resizable: false,
            maximizable: true,
            buttons:[{
                text:'关闭',
                iconCls:iconClsDefs.cancel,
                handler: function(){
                    $(that.dialog).dialog('close');
                }
            }]
        });
        $(that.dialog).dialog('center');
    },
    progress:function(href, title){
        var that = this;
        $(that.dialog).dialog({
            title: title,
            iconCls: 'fa fa-flag',
            width: window.loginMobile?'90%':1000,
            height: '95%',
            cache: false,
            href: href,
            modal: true,
            collapsible: false,
            minimizable: false,
            resizable: false,
            maximizable: true,
            buttons:[{
                text:'关闭',
                iconCls:iconClsDefs.cancel,
                handler: function(){
                    $(that.dialog).dialog('close');
                }
            }]
        });
        $(that.dialog).dialog('center');
    }
};