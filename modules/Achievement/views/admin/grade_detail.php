<form name="gradeForm" id="gradeForm" action="<?php echo admin_url() ?>module/achievement/grade/save">

    <!-- Hidden fields -->
    <input id="id" name="id" type="hidden" value="<?php echo $id ?>" />

    <!-- Name -->
    <dl class="small">
        <dt>
            <label for="name"><?php echo lang('ionize_label_name')?></label>
        </dt>
        <dd>
            <input id="name" name="name" class="inputtext required" type="text" value="<?php echo $name ?>" data-validators="required" />
        </dd>
    </dl>
</form>

<div class="buttons">
    <button id="bSavegrade_detail" type="button" class="button yes right"><?php echo lang('ionize_button_save_close') ?></button>
    <button id="bCancelgrade_detail"  type="button" class="button no right"><?php echo lang('ionize_button_cancel') ?></button>
</div>
