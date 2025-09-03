<form id="F<?=UNIQID?>" style="height:100%">
    <table class="table-form" cellpadding="5">
        <tr>
            <td width="150" class="field-label">事件</td>
            <td>
                <input name="data[title]" value="<?=$info['title']?>" style="width:100%"
                       class="easyui-textbox" required="true" validType="length[2,100]" prompt="请用一句话概括，如：xx轮融资、xx股权转让">
            </td>
        </tr>
        <tr>
            <td class="field-label">类型</td>
            <td>
                <select name="data[type]" class="easyui-combobox" style="width:150px;"
                        data-options="editable:false,required:true,value:'<?=$info['id']?$info['type']:''?>',onChange:<?=JVAR?>.ctype">
                    <option value="1">融资稀释</option>
                    <option value="2">股权转让</option>
                </select>
            </td>
        </tr>
        <tr>
            <td class="field-label">时间</td>
            <td>
                <input name="data[when]" value="<?=$info['when']?>" class="easyui-datebox" style="width:150px;" required="true" validType="date">
            </td>
        </tr>
        <tr>
            <td class="field-label">合计金额</td>
            <td>
                <input name="data[amount]" value="<?=$info['amount']?>" class="easyui-numberbox" style="width:150px;"
                       required="true" groupSeparator="," min="0">（元）
            </td>
        </tr>
        <tr>
            <td class="field-label">最新估值</td>
            <td>
                <input name="data[valuation]" value="<?=$info['valuation']?>" class="easyui-numberbox" style="width:150px;"
                       required="true" groupSeparator="," min="0">（元）
            </td>
        </tr>
        <tr>
            <td class="field-label" height="35">本轮股东表</td>
            <td>
                <?php if($info['esid']): ?>
                    <a href="javascript:void(0)" onclick="<?=JVAR?>.viewes()">点击查看</a>
                <?php else: ?>
                    <div class="easyui-panel" data-options="
                        href:'<?=url('upload/attaches',['attachmentType'=>31,
                        'externalId'=>0,
                        'replace'=>1,
                        'tpl'=>'股东表_模板.xlsx',
                        'uiStyle'=>\app\index\controller\Upload::ATTACHES_UI_LINK_STYLE])?>&callback=<?=JVAR?>.upload2',
                        border:false">
                    </div>
                    <input type="hidden" id="fid2<?=UNIQID?>" name="shareholders_excel">
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td width="150" class="field-label" style="border-top:none">投资/股转协议</td>
            <td style="border-top:none">
                <div class="easyui-panel" data-options="
                    href:'<?=url('upload/attaches',[
                    'attachmentType'=>32,
                    'externalId'=>intval($info['id']),
                    'uiStyle'=>\app\index\controller\Upload::ATTACHES_UI_LINK_STYLE])?>&callback=<?=JVAR?>.upload1',
                    border:false">
                </div>
                <input type="hidden" id="fid1<?=UNIQID?>" name="pending_files">
            </td>
        </tr>
    </table>

    <table id="T1<?=UNIQID?>" class="table-form hidden" cellpadding="5">
        <tr>
            <td class="form-tip" colspan="5" height="40">投资方明细</td>
        </tr>
        <tr>
            <td width="25%">投资方</td>
            <td width="25%">投资金额(元)</td>
            <td width="25%">持股份数(股)</td>
            <td width="25%">持股比例(%)</td>
        </tr>
    </table>
    <table id="T2<?=UNIQID?>" class="table-form hidden">
        <tr>
            <td class="form-tip" colspan="5" height="40">股转明细</td>
        </tr>
        <tr>
            <td width="20%">转让方</td>
            <td width="20%">受让方</td>
            <td width="20%">转让金额(元)</td>
            <td width="20%">转让股份(股)</td>
            <td width="20%">转让后股比(%)</td>
        </tr>
    </table>

    <div id="BTN<?=UNIQID?>" class="pd-10 text-c hidden">
        <a href="javascript:void(0)" class="easyui-linkbutton" onclick="<?=JVAR?>.add()" iconCls="icons-arrow-add">添加记录</a>
    </div>
</form>
<script type="text/javascript">
var <?=JVAR?>={isAdd:<?=$info['id']?0:1?>,type:<?=intval($info['type'])?>,detail:<?=json_encode($info['detail'],JSON_UNESCAPED_SLASHES)?>,pendingFiles:[],upload1:function(files){<?php  if(!$info['id']):?>var that=<?=JVAR?>;$.each(files,function(i,v){that.pendingFiles.push(v.attachment_id);});$('#fid1<?=UNIQID?>').val(that.pendingFiles.join(','));<?php  endif;?>},upload2:function(files){<?php  if(!$info['esid']):?>var that=<?=JVAR?>;$.each(files,function(i,v){$('#fid2<?=UNIQID?>').val(v.attachment_id);});<?php  endif;?>},del:function(el){$(el).parent().parent().remove();},add:function(){var that=<?=JVAR?>;that['add'+that.type]();},add1:function(row){if($('#T1<?=UNIQID?> tr').length>2){if(!$('#F<?=UNIQID?>').form('validate')){return false;}
var del='<a href="javascript:void(0)" onclick="<?=JVAR?>.del(this)">删除</a></td>';}else{var del='';}
var id=QT.util.uuid();if(!row||$.isEmptyObject(row)){row={who:'',amount:'',stock_total:'',stock_ratio:''};}
var tr='<tr id="'+id+'">\
        <td><input name="rows1['+id+'][who]" value="'+row.who+'" class="easyui-textbox" required="true" style="width:90%;"></td>\
        <td><input name="rows1['+id+'][amount]" value="'+row.amount+'" class="easyui-numberbox" required="true" groupSeparator="," min="0" style="width:90%;"></td>\
        <td><input name="rows1['+id+'][stock_total]" value="'+row.stock_total+'" class="easyui-numberbox" required="true" groupSeparator="," min="0" style="width:90%;"></td>\
        <td><input name="rows1['+id+'][stock_ratio]" value="'+row.stock_ratio+'" class="easyui-numberbox" suffix="%" required="true" min="0" max="100" precision="2" style="width:60%;">\
        '+del+'</td>\
        </tr>';$('#T1<?=UNIQID?>').append(tr);$.parser.parse('#'+id);},add2:function(row){if($('#T2<?=UNIQID?> tr').length>2){if(!$('#F<?=UNIQID?>').form('validate')){return false;}
var del='<a href="javascript:void(0)" onclick="<?=JVAR?>.del(this)">删除</a></td>';}else{var del='';}
var id=QT.util.uuid();if(!row||$.isEmptyObject(row)){row={from:'',to:'',amount:'',stock_total:'',stock_ratio:''};}
var tr='<tr id="'+id+'">\
        <td><input name="rows2['+id+'][from]" value="'+row.from+'" class="easyui-textbox" required="true" style="width:90%;"></td>\
        <td><input name="rows2['+id+'][to]" value="'+row.to+'" class="easyui-textbox" required="true" style="width:90%;"></td>\
        <td><input name="rows2['+id+'][amount]" value="'+row.amount+'" class="easyui-numberbox" required="true" groupSeparator="," min="0" style="width:90%;"></td>\
        <td><input name="rows2['+id+'][stock_total]" value="'+row.stock_total+'" class="easyui-numberbox" required="true" groupSeparator="," min="0" style="width:90%;"></td>\
        <td><input name="rows2['+id+'][stock_ratio]" value="'+row.stock_ratio+'" class="easyui-numberbox" suffix="%" required="true" min="0" max="100" precision="2" style="width:60%;">\
        '+del+'</td>\
        </tr>';$('#T2<?=UNIQID?>').append(tr);$.parser.parse('#'+id);},viewes:function(){var url='<?=url('enterprises/shareholdersEdit',['id'=>$info['esid'],'readonly'=>1])?>';QT.helper.view({url:url,width:800,height:'80%',dialog:'view-shareholders'});},ctype:function(v,o,isInit){var that=<?=JVAR?>;that.type=v;$('#BTN<?=UNIQID?>').removeClass('hidden');if(v=='1'){$('#T1<?=UNIQID?>').removeClass('hidden');$('#T2<?=UNIQID?>').addClass('hidden');$('#T1<?=UNIQID?>').find('.easyui-textbox').textbox('enableValidation');$('#T1<?=UNIQID?>').find('.easyui-numberbox').numberbox('enableValidation');$('#T2<?=UNIQID?>').find('.easyui-textbox').textbox('disableValidation');$('#T2<?=UNIQID?>').find('.easyui-numberbox').numberbox('disableValidation');}else{$('#T1<?=UNIQID?>').addClass('hidden');$('#T2<?=UNIQID?>').removeClass('hidden');$('#T2<?=UNIQID?>').find('.easyui-textbox').textbox('enableValidation');$('#T2<?=UNIQID?>').find('.easyui-numberbox').numberbox('enableValidation');$('#T1<?=UNIQID?>').find('.easyui-textbox').textbox('disableValidation');$('#T1<?=UNIQID?>').find('.easyui-numberbox').numberbox('disableValidation');}
if(that.isAdd||(!isInit&&$('#T'+v+'<?=UNIQID?> tr').length==2)){that['add'+v]();}},init:function(){var that=<?=JVAR?>;if(that.isAdd){return;}
that.ctype(that.type,null,true);if(!that.detail||$.isEmptyObject(that.detail)){that.detail=[[]];}
$.each(that.detail,function(i,v){that['add'+that.type](v,i==0);});}};setTimeout(<?=JVAR?>.init,500);</script>