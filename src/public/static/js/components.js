(function($) {
    function build(target, options, data) {
        if(data && data.length > 0) {
            $.each(data, function(index,row) {
                var item = $("<li/>").addClass('easyui-timeline-item');
                item.append('<i class="easyui-timeline-axis"/>');
                var content = $('<div class="easyui-timeline-content easyui-text"/>');
                content.append('<h3 class="easyui-timeline-title">' + this.time + '</h3>');
                var body = $('<div class="easyui-timeline-body"/>');

                body.html(this.content);
                content.append(body);

                item.append(content);

                if(options.onClick) {
                    item.on('click', function() {
                        options.onClick.call(target, row);
                    });
                }

                target.append(item);
            });

            if(options.onComplete) {
                options.onComplete.call(target, data);
            }
        }
    }

    $.fn.timeline = function(options) {
        if(typeof options == "string") {
            var params = [];
            for(var i = 1; i < arguments.length; i++) {
                params.push(arguments[i]);
            }
            this.each(function() {
                $.fn.timeline.methods[options].apply(this, params);
            });
            return this;
        }
        options = options || {};

        return this.each(function() {
            var data = $.data(this, "timeline");
            var newOptions;
            if(data) {
                newOptions = $.extend(data.options, options);
                data.opts = newOptions;
            } else {
                newOptions = $.extend({}, $.fn.timeline.defaults, $.fn.timeline.parseOptions(this), options);
                $.data(this, "circle", {
                    options: newOptions
                });
            }

            var target = $(this);
            target.addClass('easyui-timeline');
            if(newOptions.url) {
                $.ajax({
                    type: "get",
                    url: newOptions.url,
                    dataType: 'json',
                    success: function(data) {
                        if(newOptions.onLoadSuccess) {
                            newOptions.onLoadSuccess.call(target, data);
                        }
                        build(target, newOptions, data);
                    }
                });
            } else if(newOptions.data && newOptions.data.length > 0) {
                build(target, newOptions, newOptions.data);
            }
        });
    }

    $.fn.timeline.methods = {

    }

    $.fn.timeline.parseOptions = function(target) {
        return $.extend({}, $.parser.parseOptions(target, ["data", "url", {
            data: "array",
            url: "string"
        }]));
    };

    $.fn.timeline.defaults = {
        data: [],
        url: '',
        onLoadSuccess: function(data) {

        },
        onComplete:function(data){

        },
        onClick:function(item){

        }
    }

    $.parser.plugins.push('timeline');
})(jQuery);
/***********************************************************************************************************************/
$(function(){
    function buildAttaches($target, options){
        if(options.readOnly){
            var url = sprintf('/index.php/index/upload/viewAttaches.html?attachmentType=%d&externalId=%d&uiStyle=%d&callback=%s&prompt=%s&fit=%d',
                options.attachmentType,
                options.externalId,
                options.uiStyle,
                options.callback,
                encodeURIComponent(options.prompt),
                options.fit?1:0);
        }else{
            var url = sprintf('/index.php/index/upload/attaches.html?attachmentType=%d&externalId=%d&uiStyle=%d&callback=%s&prompt=%s&fit=%d',
                options.attachmentType,
                options.externalId,
                options.uiStyle,
                options.callback,
                encodeURIComponent(options.prompt),
                options.fit?1:0);
        }

        var $panel =$('<div data-options="border:false,' +
                'minimizable:false,' +
                'maximizable:false,' +
                'fit:' + (options.fit?'true,':'false,') +
                'href:\'' + url + '\'">' +
                '</div>').appendTo($target);

        $panel.panel();
        //$.parser.parse($panel);
    }
    function buildAttachesComplex($target, options){
        options.readOnly = options.readOnly ? 1 : 0;
        options.fit = options.fit ? 1 : 0;
        options.title = options.title ? options.title : '';
        var url = '/index.php/index/upload/attachesComplex.html?' + $.param(options);
        var $panel =$('<div data-options="border:false,\
                minimizable:false,\
                maximizable:false,\
                fit:' + (options.fit?'true':'false') + ',\
                href:\'' + url + '\'"> \
                </div>').appendTo($target);
        $panel.panel();
        //$.parser.parse($panel);
    }
    $.fn.attaches = function(options){
        if(typeof options == 'string'){
            var params = [];
            for(var i=1; i<arguments.length; i++){
                params.push(arguments[i]);
            }
            $.fn.attaches.methods[options].apply(this, params);
            return this;
        }
        options = options || {};
        this.each(function(){
            var newOptions = $.extend({}, $.fn.attaches.defaults, $.fn.attaches.parseOptions(this), options);
            var $target = $(this);
            buildAttaches($target, newOptions);
        });
        return this;
    }
    $.fn.attachesComplex = function(options){
        if(typeof options == 'string'){
            var params = [];
            for(var i=1; i<arguments.length; i++){
                params.push(arguments[i]);
            }
            $.fn.attaches.methods[options].apply(this, params);
            return this;
        }
        options = options || {};
        this.each(function(){
            var newOptions = $.extend({}, $.fn.attaches.defaults, $.fn.attaches.parseOptions(this), options);
            var $target = $(this);
            buildAttachesComplex($target, newOptions);
        });
        return this;
    }
    $.fn.attaches.methods = {
    }
    $.fn.attaches.parseOptions = function(target) {
        return $.extend({}, $.parser.parseOptions(target, ["attachmentType", "externalId", "callback", "uiStyle", "readOnly", "prompt", "fit", {
            attachmentType: "number",
            externalId: "number",
            uiStyle: "number",
            callback: "string",
            readOnly: "boolean",
            prompt: "string",
            fit: "boolean"
        }]));
    };
    $.fn.attaches.defaults = {
        attachmentType:1,
        externalId:0,
        uiStyle:1,
        callback:'',
        readOnly:false,
        prompt:'',
        attachesFit:false
    }
    $.parser.plugins.push('attaches');
    $.parser.plugins.push('attachesComplex');
});
/***********************************************************************************************************************/
$(function(){
    function buildFundContribute($target, options){
        var url = sprintf('/index.php/index/Components/fundContribute.html?fundId=%d&ffcId=%d&title=%s&uniqid=%s',
            options.fundId,
            options.ffcId,
            encodeURIComponent(options.title),
            encodeURIComponent(options.uniqid)
        );
        var $panel =$('<div data-options="border:false,\
                minimizable:false,\
                maximizable:false,\
                width:450,\
                href:\'' + url + '\'"> \
                </div>').appendTo($target);
        $panel.panel();
        //$.parser.parse($panel);
    }
    function buildFundContributeView($target, options){
        var url = sprintf('/index.php/index/Components/fundContributeView.html?ffcId=%d',
            options.ffcId
        );
        var $panel =$('<div data-options="border:false,\
                minimizable:false,\
                maximizable:false,\
                width:600,\
                href:\'' + url + '\'"> \
                </div>').appendTo($target);
        $panel.panel();
        //$.parser.parse($panel);
    }
    $.fn.fundContribute = function(options){
        if(typeof options == 'string'){
            var params = [];
            for(var i=1; i<arguments.length; i++){
                params.push(arguments[i]);
            }
            return $.fn.fundContribute.methods[options].apply(this, params);
        }
        options = options || {};
        this.each(function(){
            var newOptions = $.extend({}, $.fn.fundContribute.defaults, $.fn.fundContribute.parseOptions(this), options);
            $.data(this, 'uniqid', newOptions.uniqid);
            var $target = $(this);
            buildFundContribute($target, newOptions);
        });
        return this;
    }
    $.fn.fundContributeView = function(options){
        options = options || {};
        this.each(function(){
            var newOptions = $.extend({}, $.fn.fundContributeView.defaults, $.fn.fundContributeView.parseOptions(this), options);
            var $target = $(this);
            buildFundContributeView($target, newOptions);
        });
        return this;
    }
    $.fn.fundContribute.methods = {
        save:function(){
            var ffcIds = [];
            this.each(function() {
                var uniqid = $.data(this, 'uniqid');
                var ffcId = eval('FFC_' + uniqid + '.save()');
                ffcIds.push(ffcId);
            });
            if(ffcIds.length==0){
                return 0;
            }else if(ffcIds.length==1){
                return ffcIds[0];
            }else{
                return ffcIds;
            }
        }
    }
    $.fn.fundContribute.parseOptions = function(target) {
        return $.extend({}, $.parser.parseOptions(target, ["fundId", "ffcId", "title", "uniqid", {
            fundId: "number",
            ffcId: "number",
            title: "string",
            uniqid: "string"
        }]));
    }
    $.fn.fundContribute.defaults = {
        fundId:0,
        ffcId:0,
        title:'',
        uniqid:QT.util.uuid(8)
    }
    $.fn.fundContributeView.parseOptions = function(target) {
        return $.extend({}, $.parser.parseOptions(target, ["ffcId", {
            ffcId: "number"
        }]));
    }
    $.fn.fundContributeView.default = {
        ffcId:0
    }
    $.parser.plugins.push('fundContribute');
    $.parser.plugins.push('fundContributeView');
});
/***********************************************************************************************************************/
$(function(){
    function buildFundIncome($target, options){
        var url = sprintf('/index.php/index/Components/fundIncome.html?fundId=%d&ffiId=%d&type=%d&title=%s&uniqid=%s',
            options.fundId,
            options.ffiId,
            options.type,
            encodeURIComponent(options.title),
            encodeURIComponent(options.uniqid)
        );
        var $panel =$('<div data-options="border:false,\
                minimizable:false,\
                maximizable:false,\
                width:450,\
                href:\'' + url + '\'"> \
                </div>').appendTo($target);
        $panel.panel();
        //$.parser.parse($panel);
    }
    function buildFundIncomeView($target, options){
        var url = sprintf('/index.php/index/Components/fundIncomeView.html?ffiId=%d',
            options.ffiId
        );
        var $panel =$('<div data-options="border:false,\
                minimizable:false,\
                maximizable:false,\
                width:600,\
                href:\'' + url + '\'"> \
                </div>').appendTo($target);
        $panel.panel();
        //$.parser.parse($panel);
    }
    $.fn.fundIncome = function(options){
        if(typeof options == 'string'){
            var params = [];
            for(var i=1; i<arguments.length; i++){
                params.push(arguments[i]);
            }
            return $.fn.fundIncome.methods[options].apply(this, params);
        }
        options = options || {};
        this.each(function(){
            var newOptions = $.extend({}, $.fn.fundIncome.defaults, $.fn.fundIncome.parseOptions(this), options);
            $.data(this, 'uniqid', newOptions.uniqid);
            var $target = $(this);
            buildFundIncome($target, newOptions);
        });
        return this;
    }
    $.fn.fundIncomeView = function(options){
        options = options || {};
        this.each(function(){
            var newOptions = $.extend({}, $.fn.fundIncomeView.defaults, $.fn.fundIncomeView.parseOptions(this), options);
            var $target = $(this);
            buildFundIncomeView($target, newOptions);
        });
        return this;
    }
    $.fn.fundIncome.methods = {
        save:function(){
            var ffiIds = [];
            this.each(function() {
                var uniqid = $.data(this, 'uniqid');
                var ffiId = eval('FFI_' + uniqid + '.save()');
                ffiIds.push(ffiId);
            });
            if(ffiIds.length==0){
                return 0;
            }else if(ffiIds.length==1){
                return ffiIds[0];
            }else{
                return ffiIds;
            }
        }
    }
    $.fn.fundIncome.parseOptions = function(target) {
        return $.extend({}, $.parser.parseOptions(target, ["fundId", "ffiId", "type", "title", "uniqid", {
            fundId: "number",
            ffiId: "number",
            type: "number",
            title: "string",
            uniqid: "string"
        }]));
    }
    $.fn.fundIncome.defaults = {
        fundId:0,
        ffiId:0,
        type:1,
        title:'',
        uniqid:QT.util.uuid(8)
    }
    $.fn.fundIncomeView.parseOptions = function(target) {
        return $.extend({}, $.parser.parseOptions(target, ["ffiId", {
            ffiId: "number"
        }]));
    }
    $.fn.fundIncomeView.defaults = {
        ffiId:0
    }
    $.parser.plugins.push('fundIncome');
    $.parser.plugins.push('fundIncomeView');
});
/***********************************************************************************************************************/
$(function(){
    function buildFundEnterprise($target, options){
        var url = sprintf('/index.php/index/Components/fundEnterprise.html?fundId=%d&enterpriseId=%d&ffeId=%d&title=%s&uniqid=%s',
            options.fundId,
            options.enterpriseId,
            options.ffeId,
            encodeURIComponent(options.title),
            encodeURIComponent(options.uniqid)
        );
        var $panel =$('<div data-options="border:false,\
                minimizable:false,\
                maximizable:false,\
                width:450,\
                href:\'' + url + '\'"> \
                </div>').appendTo($target);
        $panel.panel();
        //$.parser.parse($panel);
    }
    function buildFundEnterpriseView($target, options){
        var url = sprintf('/index.php/index/Components/fundEnterpriseView.html?ffeId=%d',
            options.ffeId
        );
        var $panel =$('<div data-options="border:false,\
                minimizable:false,\
                maximizable:false,\
                width:600,\
                href:\'' + url + '\'"> \
                </div>').appendTo($target);
        $panel.panel();
        //$.parser.parse($panel);
    }
    $.fn.fundEnterprise = function(options){
        if(typeof options == 'string'){
            var params = [];
            for(var i=1; i<arguments.length; i++){
                params.push(arguments[i]);
            }
            return $.fn.fundEnterprise.methods[options].apply(this, params);
        }
        options = options || {};
        this.each(function(){
            var newOptions = $.extend({}, $.fn.fundEnterprise.defaults, $.fn.fundEnterprise.parseOptions(this), options);
            $.data(this, 'uniqid', newOptions.uniqid);
            var $target = $(this);
            buildFundEnterprise($target, newOptions);
        });
        return this;
    }
    $.fn.fundEnterpriseView = function(options){
        options = options || {};
        this.each(function(){
            var newOptions = $.extend({}, $.fn.fundEnterpriseView.defaults, $.fn.fundEnterpriseView.parseOptions(this), options);
            var $target = $(this);
            buildFundEnterpriseView($target, newOptions);
        });
        return this;
    }
    $.fn.fundEnterprise.methods = {
        save:function(){
            var ffeIds = [];
            this.each(function() {
                var uniqid = $.data(this, 'uniqid');
                var ffeId = eval('FFE_' + uniqid + '.save()');
                ffeIds.push(ffeId);
            });
            if(ffeIds.length==0){
                return 0;
            }else if(ffeIds.length==1){
                return ffeIds[0];
            }else{
                return ffeIds;
            }
        }
    }
    $.fn.fundEnterprise.parseOptions = function(target) {
        return $.extend({}, $.parser.parseOptions(target, ["fundId", "enterpriseId", "ffeId", "title", "uniqid", {
            fundId: "number",
            enterpriseId: "number",
            ffeId: "number",
            title: "string",
            uniqid: "string"
        }]));
    }
    $.fn.fundEnterprise.defaults = {
        fundId:0,
        enterpriseId:0,
        ffeId:0,
        title:'',
        uniqid:QT.util.uuid(8)
    }
    $.fn.fundEnterpriseView.parseOptions = function(target) {
        return $.extend({}, $.parser.parseOptions(target, ["ffeId", {
            ffeId: "number"
        }]));
    }
    $.fn.fundEnterpriseView.default = {
        ffeId:0
    }
    $.parser.plugins.push('fundEnterprise');
    $.parser.plugins.push('fundEnterpriseView');
});