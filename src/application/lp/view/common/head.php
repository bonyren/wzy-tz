<link rel='shortcut icon' href='/static/favicon.ico' />
<script type="text/javascript">
var SITE_URL = '<?=SITE_URL?>';
var STATIC_VER = '<?=STATIC_VER?>';
</script>
<?php include(APP_PATH . 'lp' . DS . 'view' . DS . 'common/theme.php'); ?>
<script type="text/javascript" src="/static/js/easyui/jquery.min.js"></script>
<script type="text/javascript" src="/static/js/jquery.cookie.js"></script>
<script type="text/javascript" src="/static/js/jquery.json.min.js"></script>
<script type="text/javascript" src="/static/js/easyui/jquery.easyui.min.js?<?=STATIC_VER?>"></script>
<script type="text/javascript" src="/static/js/easyui/locale/easyui-lang-zh_CN.js?<?=STATIC_VER?>"></script>
<script type="text/javascript" src="/static/js/easyui/extension/jquery-easyui-datagridview/datagrid-detailview.js?<?=STATIC_VER?>"></script>
<script type="text/javascript" src="/static/js/easyui/extension/jquery-easyui-datagridview/datagrid-groupview.js?<?=STATIC_VER?>"></script>
<script type="text/javascript" src="/static/js/easyui/extension/jquery-easyui-portal/jquery.portal.js?<?=STATIC_VER?>"></script>
<script type="text/javascript" src="/static/js/easyui/extension/datagrid-dnd/datagrid-dnd.js?<?=STATIC_VER?>"></script>
<script type="text/javascript" src="/static/js/croppic/croppic.min.js"></script>
<script type="text/javascript" src="/static/js/pdfobject.js"></script>
<script type="text/javascript" src="/static/js/jquery.app.js?<?=STATIC_VER?>"></script>
<script type="text/javascript" src="/static/js/common.js?<?=STATIC_VER?>"></script>
<script type="text/javascript" src="/static/js/sprintf.js"></script>
<script type="text/javascript" src="/static/highcharts/code/highcharts.js"></script>
<script type="text/javascript" src="/static/highcharts/code/modules/timeline.js"></script>
<script type="text/javascript" src="/static/js/md5.min.js"></script>
<script type="text/javascript" src="/static/js/components.js?<?=STATIC_VER?>"></script>
<script>
    var iconClsDefs = <?=json_encode(\app\index\logic\Defs::$iconClsDefs, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)?>;
</script>