<form name="klassForm" id="klassForm" action="<?php echo admin_url() ?>module/achievement/klass/save">

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
</form>

<!-- Save / Cancel buttons
	 Must be named bSave[windows_id] where 'window_id' is the used ID
	 or the window opening through ION.formWindow()
-->
<div class="buttons">
    <button id="bSaveklass_detail" type="button" class="button yes right"><?php echo lang('ionize_button_save_close') ?></button>
    <button id="bCancelklass_detail"  type="button" class="button no right"><?php echo lang('ionize_button_cancel') ?></button>
</div>
