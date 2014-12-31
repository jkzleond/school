<form name="subjectForm" id="subjectForm" action="<?php echo admin_url() ?>module/achievement/subject/save">

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
    <!-- Title -->
    <dl class="small">
        <dt>
            <label for="title"><?php echo lang('ionize_label_title')?></label>
        </dt>
        <dd>
            <!--
            The validation of this mandatory field is first done by JS
            by adding the attribute data-validators="required"
            see : http://mootools.net/docs/more/Forms/Form.Validator#Validators
            -->
            <input id="title" name="title" class="inputtext required" type="text" value="<?php echo $title ?>" data-validators="required" />
        </dd>
    </dl>
</form>

<div class="buttons">
    <button id="bSavesubject_detail" type="button" class="button yes right"><?php echo lang('ionize_button_save_close') ?></button>
    <button id="bCancelsubject_detail"  type="button" class="button no right"><?php echo lang('ionize_button_cancel') ?></button>
</div>
