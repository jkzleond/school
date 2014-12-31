<form name="examForm" id="examForm" action="<?php echo admin_url() ?>module/achievement/exam/save">

    <!-- Hidden fields -->
    <input id="id" name="id" type="hidden" value="<?php echo $id ?>" />

    <!-- Name -->
    <dl class="small">
        <dt>
            <label for="name"><?php echo lang('ionize_label_name')?></label>
        </dt>
        <dd>
            <!--
            The validation of this mandatory field is first done by JS
            by adding the attribute data-validators="required"
            see : http://mootools.net/docs/more/Forms/Form.Validator#Validators
            -->
            <input id="name" name="name" class="inputtext required" type="text" value="<?php echo $name ?>" data-validators="required" />
        </dd>
    </dl>

    <!-- Start_date -->
    <dl class="small">
        <dt>
            <label><?php echo lang('module_achievement_label_start_date')?></label>
        </dt>
        <dd>
            <input id="startDate" name="start_date" class="inputtext date" type="text" value="<?php echo $start_date ?>" data-validators="required" />
        </dd>
    </dl>

</form>

<!-- Save / Cancel buttons
	 Must be named bSave[windows_id] where 'window_id' is the used ID
	 or the window opening through ION.formWindow()
-->
<div class="buttons">
    <button id="bSaveexam_detail" type="button" class="button yes right"><?php echo lang('ionize_button_save_close') ?></button>
    <button id="bCancelexam_detail"  type="button" class="button no right"><?php echo lang('ionize_button_cancel') ?></button>
</div>

<script type="text/javascript">
    ION.initDatepicker('<?php echo Settings::get('date_format') ?>');
</script>