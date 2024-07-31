<div id="attaches_<?=$uniqid?>">
    <?php foreach($bindValues['attaches'] as $attach){ ?>
        <div id="attach_file_<?=$uniqid?>_<?=$attach['attachment_id']?>" class="attach-box-light">
            <div class="text-center mt-1 mr-1 pull-left">
                <a title="<?=$attach['original_name']?>" href="javascript:void(0)" onclick="QT.filePreview(<?=$attach['attachment_id']?>)">
                    <?=$attach['original_name']?>
                </a>
            </div>
            <div class="text-center mt-1 attach-buttons pull-left">
                <a class="size-MINI fa fa-download" href="<?=$attach['download_url']?>" target="_blank">&nbsp;</a>
            </div>
        </div>
    <?php } ?>
</div>