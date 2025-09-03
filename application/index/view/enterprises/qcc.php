<html>
<head>
    <meta charset="UTF-8">
    <style>
        body, html {
            font-family: "Microsoft YaHei",Arial,sans-serif;
            font-size: 14px;
            line-height: 1.5714285714;
            -webkit-font-smoothing: antialiased;
            color: #333;
            margin: 0;
        }
        body{background:#f6f6f6}
        a{text-decoration: none;}
        em{font-style: normal;}
        .search,.container{width:900px;margin:0 auto;background:#ffffff}
        .search{margin-bottom:20px;padding: 30px 0;text-align: center;}
        .search-input-bg{
            border: 1px solid #4791ff;
            background: #fff;
            display: inline-block;
            vertical-align: top;
            width: 539px;
            height: 34px;
            margin-right: -5px;
            border-right-width: 0;
            overflow: hidden;
            position: relative;
        }
        .search-input-bg input{
            width: 526px;
            height: 22px;
            font: 16px/18px arial;
            line-height: 22px;
            margin: 6px 0 0 7px;
            padding: 0;
            background: transparent;
            border: 0;
            outline: 0;
        }
        .search-btn-bg{
            width: auto;
            height: auto;
            display: inline-block;
            background-position: -120px -48px;
            z-index: 0;
            vertical-align: top;
            border-bottom: 1px solid transparent;
        }
        .search-btn-bg input{
            border: 0;
            width: 100px;
            height: 36px;
            color: #fff;
            font-size: 15px;
            letter-spacing: 1px;
            background: #3385ff url('/static/img/search.png') no-repeat center;
            background-size: 20px;
            border-bottom: 1px solid #2d78f4;
            outline: medium;
            cursor: pointer;
        }
        .search-btn-bg input:hover {
            background-color: #317ef3;
            border-bottom: 1px solid #2868c8;
            box-shadow: 1px 1px 1px #ccc;
        }
        .result-tips {border-bottom: 1px solid #f3f3f3;background: #fcfcfc;color: #333;padding: 10px 16px;}
        .result-tips .kw{color:#ff3b30}

        .m-l {margin-left: 15px;}
        .m-l-xs {margin-left: 5px;}
        .text-primary {color: #128bed;}
        .text-success-lt {color: #009944;}
        table.m_srchList{font-size:14px;font-size: 14px;width: 100%;border-spacing: 0;border-collapse: collapse;}
        table.m_srchList tr {
            border:1px solid #eee;
            border-left: 0;
            border-right: 0;
            border-collapse: collapse;
        }
        table.m_srchList tr td.checktd {display: none;}
        table.m_srchList tr td {
            text-align: left;
            padding-left: 10px;
            padding-right: 10px;
            color: #666;
            padding-top: 20px;
            padding-bottom: 20px;
        }
        table.m_srchList tr td.imgtd {
            padding-left: 25px;
        }
        table.m_srchList tr td img {
            width: 80px;
            max-height: 80px;
            border-radius: 4px;
        }
        .icon-ptrz110 {
            display: block;
            position: absolute;
            z-index: 5;
            background-image: url(https://www.qichacha.com/material/theme/chacha/cms/v2/images/icon_ptrz110.png);
            background-size: 118px 31px;
            width: 118px;
            height: 31px;
            margin-left: -19px;
            margin-top: -13px;
        }
        table.m_srchList .ma_h1 {
            display: inline-block;
            font-size: 18px;
            color: #222;
            font-weight: bold;
            padding-bottom: 0px;
            max-height: 100px;
            max-width: 550px;
            word-break: break-all;
        }
        table.m_srchList tbody tr .ma_h1 {
            line-height: 1.4;
            margin-bottom: 5px;
        }
        table.m_srchList tr td em {
            color: #FD485E;
        }
        .ntag {
            font-weight: normal;
            display: inline-block;
            line-height: 14px;
            font-size: 12px;
            padding: 4px 8px 4px 8px;
            margin-right: 4px;
            border-radius: 2px;
        }
        .ntag.text-primary {
            color: #128BED;
            background: #E7F4FF;
        }
        table.m_srchList p {
            margin: 5px 0 3px;
            color: #666;
        }
        table.m_srchList tr td.statustd {
            text-align: right;
            padding-right: 15px;
            position: relative;
            vertical-align: top;
        }
        .nstatus {
            font-weight: normal;
            /*display: inline-block;*/
            display:none;
            line-height: 16px;
            font-size: 14px;
            padding: 4px 8px 4px 8px;
            border-radius: 2px;
            border-style: solid;
            border-width: 1px;
        }
        table.m_srchList tr td.statustd .hphoneview {display: none}
        .add-to-project{border: 1px solid #4791ff;color:#4791ff;padding: 4px 8px 4px 8px;}
        .add-to-project:hover {color: #2868c8;border: 1px solid #2868c8;box-shadow: 1px 1px 1px #ccc;}
    </style>
</head>
<body>
<div class="search">
    <form id="searchForm" method="post" action="<?=$search_url?>">
        <span class="search-input-bg">
            <input name="kw" maxlength="255" autocomplete="off" autofocus="autofocus" placeholder="请输入企业名称、姓名、品牌/产品名称等">
        </span>
        <span class="search-btn-bg">
            <input type="submit" value="" class="bg s_btn">
        </span>
    </form>
</div>
<div class="container">
    <?php if ($search): ?>
    <div class="result-tips">
        <?php if ($error): ?>
            搜索失败：<span class="kw"><?=$error?></span>
        <?php else: ?>
            <span class="kw">“<?=htmlspecialchars($kw)?>”</span>的搜索结果如下
        <?php endif; ?>
    </div>
    <?php endif; ?>
    <?php echo $companies; ?>
</div>
</body>
<script type="text/javascript" src="/static/js/jquery.min.js"></script>
<script type="text/javascript">
$('td.statustd').remove();$('.org-content').remove();$('.phoneview-wrap').remove();$('.search-icons').remove();$('.app-copy').remove();$('.bottomRight').remove();$('.nstatus').replaceWith('<a href="javascript:void(0)" class="add-to-project" onclick="add(this)">+项目</a>');$('#searchForm').submit(function(){var kw=$.trim($(this).find('input[name="kw"]').val());if(kw===''){$(this).find('input[name="kw"]').val('').focus();return false;}});function zhugeTrack(){var href=$(window.event.target).attr('href');if(href){window.open('https://www.qichacha.com'+href);}
if(window.event.preventDefault){window.event.preventDefault();}else{window.event.returnValue==false;}}
function addSearchIndex(){}
function showVipModal(){}
function loginPermision(){}
function add(that){var html=$(that).parent().parent().html();var data={name:'',boss:'',phone:''};var matches=html.match(/\{'内容类型':'.*?','内容名称':'.*?'\}/isg);if(matches&&matches.length){for(var i in matches){try{var obj=JSON.parse(matches[i].replace(/'/g,'"'));if(obj['内容类型']=='企业'){data.name=obj['内容名称'].replace(/\s+/sg,'');}else if(obj['内容类型']=='法定代表人'){data.boss=obj['内容名称'].replace(/\s+/sg,'');}}catch(e){}}}
var matches=html.match(/电话：(.*?)<\/span>/is);if(matches&&matches[1]){data.phone=matches[1].replace(/\s+/sg,'');}
var matches=html.match(/地址：(.*?)<\/p>/is);if(matches&&matches[1]){data.address=matches[1].replace(/[\s+(<em>)(<\/em>)]/sg,'');}
window.parent.EnterpriseModule.add(data);}</script>
</html>