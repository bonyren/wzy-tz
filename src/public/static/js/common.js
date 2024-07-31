var GLOBAL = {};
GLOBAL.namespace = function(str){
    var arr = str.split("."),o=GLOBAL;
    for(var i=((arr[0] == 'CACHE')?1:0); i<arr.length; i++){
        o[arr[i]] = o[arr[i]] || {};
        o=o[arr[i]];
    }
};
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
GLOBAL.namespace('func');
GLOBAL.func.random = function(min, max){
    var Range = max - min;
    var Rand = Math.random();
    return(min + Math.round(Rand * Range));
};
GLOBAL.func.moneyFormat = function(num){
    if(!num){
        return '';
    }
    if(typeof(num) == 'number'){
        num = num.toFixed(2);
    }
    var numStr = num.toString();
    numStr = numStr.replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
    return numStr;
}
GLOBAL.func.byteFormat = function(num){
    if(!num){
        return '';
    }
    if(typeof(num) == 'number'){
        num = num.toFixed(2);
    }
    var numStr = num.toString();
    numStr = numStr.replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
    numStr = numStr.replace('.00', '');
    return numStr;
}
GLOBAL.func.dateFilter = function(date){
    if(date == '0000-00-00' || date == '1970-01-01'){
        return '';
    }
    return date;
}
GLOBAL.func.dateTimeFilter = function(dateTime){
    if(dateTime == '0000-00-00 00:00:00' || dateTime == '1970-01-01 00:00:00'){
        return '';
    }
    return dateTime;
}
GLOBAL.func.addUrlParam = function(url, name, value){
    url += url.indexOf('?') === -1?'?':'&';
    url += encodeURIComponent(name) + '=' + encodeURIComponent(value);
    return url;
}
GLOBAL.func.escapeALinkStringParam = function(str) {
    if(!str){
        return '';
    }
	//转换半角单引号
	str = str.replace(/'/g, "\\'");
    str = str.replace(/"/g, "");
    str = str.replace(/\\/g, "\\");
	return str;
}
GLOBAL.func.formatBoolean = function(val){
    if(val){
        return '<span class="badge badge-success">是</span>';
    }else{
        return '<span class="badge badge-warning">否</span>';
    }
}
GLOBAL.func.formatDouble2 = function(val){
    return val.toFixed(2);
}
GLOBAL.func.escapeChar = function(str) {
    if(!str){
        return str;
    }
	//转换半角单引号
	str = str.replace(/\'/g, "\\\'");
	//也可以使用&acute;
	str = str.replace(/\'/g, "&acute;");
	return str;
}
GLOBAL.namespace('css');
GLOBAL.css.table = {
		trGray: 'color:#999;background-color:#F3F3F3;',
		trWarn: 'color:#FF0000;background:#FFB90F;',
		trError: 'color:#FF0000;background:#FFF8DC;',
		trDel: 'text-decoration:line-through;',
		trSuc: 'color:#5ebfef;background-color:#f5f7d6;'
};
GLOBAL.namespace('HelperDialog');
var DEFAULT_DB_DATE_VALUE = '0000-00-00';
var DEFAULT_DB_DATETIME_VALUE = '0000-00-00 00:00:00';
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
var commonModule = {
    IsEmptyObject: function(obj){
        for(var n in obj){return false}
        return true;
    }
}
var HtmlUtil = {
    /*1.用浏览器内部转换器实现html转码*/
    htmlEncode:function (html){
        /*
        //1.首先动态创建一个容器标签元素，如DIV
        var temp = document.createElement ("div");
        //2.然后将要转换的字符串设置为这个元素的innerText(ie支持)或者textContent(火狐，google支持)
        (temp.textContent != undefined ) ? (temp.textContent = html) : (temp.innerText = html);
        //3.最后返回这个元素的innerHTML，即得到经过HTML编码转换的字符串了
        var output = temp.innerHTML;
        temp = null;
        return output;*/
        return html
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    },
    /*2.用浏览器内部转换器实现html解码*/
    htmlDecode:function (text){
        //1.首先动态创建一个容器标签元素，如DIV
        var temp = document.createElement("div");
        //2.然后将要转换的字符串设置为这个元素的innerHTML(ie，火狐，google都支持)
        temp.innerHTML = text;
        //3.最后返回这个元素的innerText(ie支持)或者textContent(火狐，google支持)，即得到经过HTML解码的字符串了。
        var output = temp.innerText || temp.textContent;
        temp = null;
        return output;
    }
};

var QT = {
    util:{
        uuid:function(len, radix){
            var chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.split('');
            var uuid = [], i;
            radix = radix || chars.length;
            if (len) {
                // Compact form
                for (i = 0; i < len; i++) uuid[i] = chars[0 | Math.random()*radix];
            } else {
                // rfc4122, version 4 form
                var r;
                // rfc4122 requires these characters
                uuid[8] = uuid[13] = uuid[18] = uuid[23] = '-';
                uuid[14] = '4';
                // Fill in random data.  At i==19 set the high bits of clock sequence as
                // per rfc4122, sec. 4.1.5
                for (i = 0; i < 36; i++) {
                    if (!uuid[i]) {
                        r = 0 | Math.random()*16;
                        uuid[i] = chars[(i == 19) ? (r & 0x3) | 0x8 : r];
                    }
                }
            }
            return uuid.join('');
        },
    },
    helper:{
        genDialogId:function(dialogId){
            if (!dialogId) {
                dialogId = QT.util.uuid(8);
            }
            if (!$('#'+dialogId).length) {
                $('#dialog-uuid-replace').html('<div id="'+dialogId+'"></div>');
            }
            return $('#'+dialogId);
        },
        dialog:function(title,href,isSubmit,callback,width,heigth,dialogId,icon){
            var $dialog = QT.helper.genDialogId(dialogId?dialogId:'qt-helper-dialog');
            var btns = [];
            if (isSubmit) {
                btns.push({
                    text:'提交',
                    iconCls:iconClsDefs.ok,
                    handler: function(){
                        if (typeof GLOBAL.HelperDialog.submit == 'function') {
                            GLOBAL.HelperDialog.submit(href,$dialog,function () {
                                if (callback) {
                                    callback($dialog);
                                }
                                GLOBAL.HelperDialog = {};
                            });
                        } else {
                            if (callback) {
                                callback($dialog);
                            }
                        }
                    }
                });
            }
            btns.push({
                text:isSubmit?'取消':'关闭',
                iconCls:iconClsDefs.cancel,
                handler: function(){
                    GLOBAL.HelperDialog = {};
                    $dialog.dialog('close');
                    if (!isSubmit && callback) {
                        callback();
                    }
                }
            });
            $dialog.dialog({
                title: title,
                iconCls: icon ? icon : 'fa fa-pencil-square',
                width: width ? width : (window.loginMobile?'90%':900),
                height: heigth ? heigth : '95%',
                href: href,
                modal: true,
                border:true,
                buttons:btns
            });
            $dialog.dialog('center');
        },
        view:function (params) {
            var options = {
                title:'详情',
                iconCls:'fa fa-eye',
                href:'',
                width: window.loginMobile?'90%':900,
                height:'95%',
                modal: true,
                border:true,
                buttons:[]
            };
            if (params.url) {
                options.href = params.url;
            }
            if (params.dialog) {
                params.dialog = params.dialog.replace('#','');
                var $dialog = QT.helper.genDialogId(params.dialog);
            } else {
                var $dialog = QT.helper.genDialogId('qt-helper-dialog');
            }
            $.extend(options, params);
            $dialog.dialog(options);
            $dialog.dialog('center');
        }
    },
    auditLogs:function(model,record_id,field){
        if (!field) {
            field = '';
        }
        var url = SITE_URL+'/index/audit_logs/view?model='+model+'&record_id='+record_id+'&field='+field;
        var btn = '<a href="javascript:;" class="btn size-MINI radius" onclick="QT.helper.dialog(\'修改日志\',\''+url+'\')" title="修改日志">'
            +'<i class="fa fa-commenting-o fa-lg"></i></a>';
        return btn;
    },
    filePreview:function(attachmentId,newTab){
        if ('undefined' === typeof newTab) {
            newTab = 1;
        }
        var url = SITE_URL + '/index/upload/previewAttach?attachmentId='+attachmentId+'&newTab='+newTab;
        if (newTab) {
            window.open(url);
        } else {
            QT.helper.view({title:'附件预览',url:url,width:'100%',height:'100%',dialog:'file-preview-dialog'});
        }
    },
    tagger:{
        work:function(url,title,input_id){
            var that = this;
            if (url == '') {
                return;
            }
            url = url + '&default_value=' + $('#'+input_id).val();
            var $dialog = QT.helper.genDialogId('tagger-dialog');
            $dialog.dialog({
                title: title,
                width: 775,
                height: "90%",
                href: url,
                modal: true,
                border:false,
                buttons:[{
                    text:'确定',
                    iconCls:iconClsDefs.ok,
                    handler: function(){
                        var values=[], htmls='', $tags = $dialog.find('.qt-tag-exists').children('.qt-tag-label');
                        if ($tags.length) {
                            $.each($tags,function(){
                                var id = $(this).attr('tag-id'), name = $(this).attr('tag-name');
                                values.push(id);
                                htmls += '<span class="qt-tag-label" tag-id="'+id+'">' + name +
                                    '<a href="javascript:;" class="qt-tag-remove" onclick="QT.tagger.remove(this,\''+input_id+'\')"></a>' +
                                    '</span>';
                            });
                        }
                        $('#'+input_id).val(values.join(',')).next('.qt-tagger-preview').html(htmls);
                        $dialog.dialog('close');
                    }
                },{
                    text:'取消',
                    iconCls:iconClsDefs.cancel,
                    handler: function(){
                        $dialog.dialog('close');
                    }
                }]
            });
            $dialog.dialog('center');
        },
        remove:function(clk,input_id){
            var that = this, $value_input = $('#'+input_id);
            if (!$value_input.length) {
                return;
            }
            var $tag = $(clk).parent();
            var remove_id = $tag.attr('tag-id'),
                values = new Set($value_input.val().split(','));
            values.delete(remove_id);
            $value_input.val(values.size ? Array.from(values).join(',') : '');
            $(clk).parent().remove();
        }
    },
    selector:{
        init:function(){
            var that = this;
            $(document).on('click', '.qt-plug-selector-btn', function(){
                var options = that.parseOptions($(this).attr('qt-plug-options'));
                options['clickElem'] = $(this);
                that.work(options);
                return false;
            });
            $(document).on('click', '.qt-plug-selector-remove', function(){
                var valueElem = $($(this).attr('target-elem'));
                var removeValue = $(this).attr('target-val');
                var orgValue = valueElem.val().split(',');
                var newValue = [];
                for (var i in orgValue) {
                    if (orgValue[i] == removeValue) {
                        continue;
                    }
                    newValue.push(orgValue[i]);
                }
                valueElem.val(newValue.join(','));
                $(this).parent().remove();
                return false;
            });
            that.isInited = true;
        },
        parseOptions:function(str){
            str = str.replace(/\s+/igm, '');
            str = 'var options = {' + str + '}';
            eval(str);
            return options;
        },
        work:function(options){
            var $dialog = QT.helper.genDialogId('selector-dialog'),
                conf = {
                    clickElem:'',
                    valElem:'',
                    valField:'id',
                    txtField:'name',
                    multiple:false,
                    removeAble:true,
                    onSelected:null,
                    url:''
                };
            $.extend(conf, options);
            if (conf.url == '') {
                return;
            }
            conf.url += /\?/.test(conf.url) ? '&dialog_call=1' : '?dialog_call=1';
            conf.url += conf.multiple ? '&multiple=1' : '&multiple=0'; //多选or单选
            $dialog.dialog({
                title: '选择器',
                width: "90%",
                height: "90%",
                href: conf.url,
                modal: true,
                border: true,
                buttons:[{
                    text:'确定',
                    iconCls:iconClsDefs.ok,
                    handler: function(){
                        var rows = $dialog.find('.easyui-datagrid').datagrid('getChecked');
                        if (!rows.length) {
                            $.app.method.tip('提示', '未选择任何数据', 'error');
                            return;
                        }

                        var oldValues = conf.valElem ? $(conf.valElem).val() : '',
                            addValues = [],
                            html = [];

                        oldValues = new Set( oldValues === '' ? [] : oldValues.split(',') );

                        for (var i in rows) {
                            var _val = rows[i][conf.valField] + '';
                            if (oldValues.has(_val)) {
                                continue; //已存在的值不重复加入
                            }
                            addValues.push(_val);
                            var delbtn;
                            if (conf.removeAble) {
                                delbtn = '<a href="javascript:void(0)" class="qt-plug-selector-remove" target-elem="'+conf.valElem+'" target-val="'+_val+'"></a>';
                            } else {
                                delbtn = '';
                            }
                            html.push('<span class="i-act-btn">' + rows[i][conf.txtField] + delbtn + '</span>');
                        }

                        if (!addValues.length) {
                            $dialog.dialog('close');
                            return;
                        }

                        //设置值
                        if (conf.type != 'callback' && conf.valElem) {
                            var setValues = addValues;
                            if (conf.multiple) {
                                setValues = setValues.concat(Array.from(oldValues)); //多选支持追加
                            }
                            $(conf.valElem).val(setValues.join(','));
                            //设置预览文字
                            var cls = 'qt-plug-selector-preview',
                                $preview = conf.clickElem.prev('.' + cls);
                            if ($preview.length) {
                                if (conf.multiple) {
                                    $preview.append(html.join(''));
                                } else {
                                    $preview.html(html.join(''));
                                }
                            } else {
                                conf.clickElem.before('<div style="display:inline-block" class="' + cls + '">' + html.join('') + '</div>');
                            }
                        }

                        //关闭选择器弹窗
                        $dialog.dialog('close');

                        //执行回调函数
                        if ('function' === typeof conf.onSelected) {
                            conf.onSelected(addValues.join(','));
                        }
                    }
                },{
                    text:'取消',
                    iconCls:iconClsDefs.cancel,
                    handler: function(){
                        $dialog.dialog('close');
                    }
                }]
            });
            $dialog.dialog('center');
        }
    },
    follow:function(obj,type,id){
        $.messager.progress({text:'处理中，请稍候...'});
        //var action = $.data(obj, 'action');
        var action = $(obj).data('action');
        $.post(SITE_URL + '/index/index/follow',{target_type:type,target_id:id,action:action},function(res){
            $.messager.progress('close');
            if(!res.code){
                $.app.method.alertError(null, res.msg);
            }else{
                if (action == 1) {
                    $(obj).attr('title','已关注').children('i').attr('class','fa fa-star').text('已关注');
                    $(obj).data('action', '0');
                } else {
                    $(obj).attr('title','未关注').children('i').attr('class','fa fa-star-o').text('未关注');
                    $(obj).data('action', '1');
                }
            }
        },'json');
    }
};
QT.selector.init();

(function($){
    function setHeight(target){
        var opts = $(target).textbox('options');
        $(target).next().css({
            height: '',
            minHeight: '',
            maxHeight: ''
        });
        var tb = $(target).textbox('textbox');
        tb.css({
            height: 'auto',
            minHeight: opts.minHeight,
            maxHeight: opts.maxHeight
        });
        tb.css('height', 'auto');
        var height = tb[0].scrollHeight;
        tb.css('height', height+'px');
    }

    function autoHeight(target){
        var opts = $(target).textbox('options');
        var onResize = opts.onResize;
        opts.onResize = function(width,height){
            onResize.call(this, width, height);
            setHeight(target);
        }
        var tb = $(target).textbox('textbox');
        tb.unbind('.tb').bind('keydown.tb keyup.tb', function(e){
            setHeight(target);
        });
        setHeight(target);
    }
    $.extend($.fn.textbox.methods, {
        autoHeight: function(jq){
            return jq.each(function(){
                autoHeight(this);
            })
        }
    });
})(jQuery);