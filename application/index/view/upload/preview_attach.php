<style>
    .preview-container{position:relative;height:100%;width:100%;}
    .preview-container .loading{position:absolute;width:100%;background:#FFF;text-align: center;display:table}
    .preview-container .loading div{height:300px;display:table-cell;vertical-align:middle;}
    .preview-container .preview-attach{position:relative;margin:0;padding:0;width:100%;height:100%}
    .preview-container #attach-preview-image{text-align: center}
    .preview-container #attach-preview-none{font-family: 'Microsoft Yahei';font-size:20px;}
    .attach-info {position:absolute;width:100%;bottom:0;text-align: center;background-color: #FEFEE9;border-top:1px solid #B1B1B1}
    .attach-info h2{font-family: 'Microsoft Yahei';display: inline-block}
    .preview-container .preview-attach #attach-preview-pdf {width:100%;height:100%}
    .preview-container .preview-attach .attach-preview-pdf-cover{
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
    }
</style>
<div class="preview-container">
    <?php if($preview_type == 'office') : ?>
        <div class="loading">
            <div>
                <img src="/static/img/loading.gif">
                <p>Loading..</p>
            </div>
        </div>
        <iframe class="preview-attach" id="attach-preview-office" frameborder="0" src="<?=$preview_url?>"></iframe>
    <?php elseif($preview_type == 'image') : ?>
        <div class="preview-attach" id="attach-preview-image">
            <img src="<?=$preview_url?>" border="0"  height="500px" >
            <div style="position: absolute;z-index:10;right: 50px;top: 50px">
                <a href="javascript:void(0)" class="previewImageM btn btn-default fa fa-search-minus"></a>
                <a href="javascript:void(0)" class="previewImageP btn btn-default fa fa-search-plus"></a>
            </div>
        </div>
    <?php elseif($preview_type == 'pdf') : ?>
        <?php if($loginMobile && !isSafari()){ ?>
            <iframe class="preview-attach" frameborder="0" src="<?=$preview_url?>" scrolling="auto"></iframe>
        <?php }else{ ?>    
            <div class="preview-attach">
                <div id="attach-preview-pdf"></div>
                <!--盖住embeded区域，禁用右键菜单下载pdf-->
                <!--
                <div class="attach-preview-pdf-cover"></div>
                -->
            </div>
        <?php } ?>
    <?php else : ?>
        <table class="preview-attach" id="attach-preview-none" width="100%">
            <tr>
                <td align="center">
                    <p class="bg-warning"><?=$error_msg?></p>
                </td>
            </tr>
        </table>
    <?php endif; ?>
</div>
<script>
var ifrm=document.getElementById('attach-preview-office');if(ifrm){ifrm.onload=ifrm.onreadystatechange=function(){if(this.readyState&&this.readyState!='complete'){return;}
$('.loading').remove();}}else{var $pdf=$('#attach-preview-pdf');if($pdf.length){PDFObject.embed("<?=$preview_url?>",$pdf,{pdfOpenParams:{view:'Fit',scrollbars:'0',toolbar:'0',statusbar:'0',navpanes:'0'}});}}
$(function(){$(".previewImageP").click(function(){$("#attach-preview-image").find("img").attr("height",(parseInt($("#attach-preview-image").find("img").attr("height"))+10)+"px");});$(".previewImageM").click(function(){$("#attach-preview-image").find("img").attr("height",(parseInt($("#attach-preview-image").find("img").attr("height"))-10)+"px");});});</script>