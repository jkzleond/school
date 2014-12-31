<div class="divider">
    <a class="button light" id="manageExamToolbarButton">
        <i class="icon-clock"></i><?= lang('module_achievement_button_manage_exam') ?>
    </a>
</div>
<div class="divider">
    <a class="button light" id="manageSubjectToolbarButton">
        <i class="icon-table"></i><?= lang('module_achievement_button_manage_subject') ?>
    </a>
</div>
<!--<div class="divider">
    <a class="button light" id="newStudentToolbarButton">
        <i class="icon-user"></i><?/*= lang('module_achievement_button_manage_student') */?>
    </a>
</div>-->

<script type="text/javascript">
    $('manageExamToolbarButton').addEvent('click', function(){
        ION.dataWindow(
            'exam',
            Lang.get('module_achievement_label_manage_exam'),
            'module/achievement/exam/manage/',
            {
                width: 350,
                height: 400
            }
        );
    });
    $('manageSubjectToolbarButton').addEvent('click', function(){
        ION.dataWindow(
            'subject',
            Lang.get('module_achievement_label_manage_subject'),
            'module/achievement/subject/manage',
            {
                width: 350,
                height: 400
            }
        );
    });
/*    $('newStudentToolbarButton').addEvent('click', function(){
        ION.formWindow(
            'student',
            'studentForm',
            Lang.get('module_achievement_label_new_student'),
            admin_url + 'module/achievement/student/create',
            {
                width: 350,
                height: 200
            }
        );
    });*/
</script>