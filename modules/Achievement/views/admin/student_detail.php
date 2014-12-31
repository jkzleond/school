<form name="studentForm" id="studentForm" action="<?php echo admin_url() ?>module/achievement/student/save">

    <!-- Hidden fields -->
    <input id="id" name="id" type="hidden" value="<?php echo $id ?>" />

    <!-- Number -->
    <dl class="small">
        <dt>
            <label for="number"><?php echo lang('module_achievement_label_student_number')?></label>
        </dt>
        <dd>
            <input id="number" name="number" class="inputtext required" type="text" value="<?php echo $number ?>" data-validators="required" />
        </dd>
    </dl>

    <!-- Name -->
    <dl class="small">
        <dt>
            <label for="name"><?php echo lang('module_achievement_label_student_name')?></label>
        </dt>
        <dd>
            <input id="name" name="name" class="inputtext required" type="text" value="<?php echo $name ?>" data-validators="required" />
        </dd>
    </dl>
    <!-- Grade -->
    <dl class="small">
        <dt>
            <label for="moduleAchievementGradeSelect"><?php echo lang('module_achievement_label_grade')?></label>
        </dt>
        <dd>
            <select name="grade_id" id="moduleAchievementGradeSelect">

            </select>
            <a id="moduleAchievementGradeManageButton" class="button light small right">
                <i class="icon-plus"></i>
            </a>
        </dd>
    </dl>
    <!-- Class -->
    <dl class="small">
        <dt>
            <label for="moduleAchievementClassSelect"><?php echo lang('module_achievement_label_class')?></label>
        </dt>
        <dd>
            <select name="class_id" id="moduleAchievementClassSelect" >

            </select>
            <a id="moduleAchievementClassManageButton" class="button light small right">
                <i class="icon-plus"></i>
            </a>
        </dd>
    </dl>
</form>

<div class="buttons">
    <button id="bSavestudent_detail" type="button" class="button yes right"><?php echo lang('ionize_button_save_close') ?></button>
    <button id="bCancelstudent_detail"  type="button" class="button no right"><?php echo lang('ionize_button_cancel') ?></button>
</div>

<script type="javascript">
    ION.HTML(
        admin_url + 'module/achievement/grade/get_list/option/<?php echo $grade_id ?>',
        {},
        {update: 'moduleAchievementGradeSelect'}
    );
    ION.HTML(
        admin_url + 'module/achievement/klass/get_list/option/<?php echo $class_id ?>',
        {},
        {update: 'moduleAchievementClassSelect'}
    );

    $('moduleAchievementGradeManageButton').addEvent('click',function(e){
        ION.dataWindow(
            'grade',
            Lang.get('module_achievement_label_manage_grade'),
            'module/achievement/grade/manage',
            {
                width:350,
                height:400
            }
        );
    });

    $('moduleAchievementClassManageButton').addEvent('click',function(e){
        ION.dataWindow(
            'klass',
            Lang.get('module_achievement_label_manage_class'),
            'module/achievement/klass/manage',
            {
                width:350,
                height:400
            }
        );
    });
</script>
