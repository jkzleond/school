<h2 class="main exams"><?php echo lang('module_achievement_title_subject'); ?></h2>
<div class="main subtitle">
    <p><span class="lite">科目的管理</span></p>
</div>
<div id="exams">
    <div class="divider">
        <a class="button light" id="createSubjectPanelButton">
            <i class="icon-plus"></i><?= lang('module_achievement_button_create_subject') ?>
        </a>
    </div>
    <h3 class="toggler toggler-items expand" title="科目列表">科目列表</h3>
    <div id="moduleAchievementSubjectList" class="element element-items" style="padding-top: 0px; border-top-style: none; padding-bottom: 0px; border-bottom-style: none; overflow: hidden; height: auto;">

    </div>
</div>
<script type="text/javascript">
    ION.HTML(
        admin_url + 'module/achievement/subject/get_list',
        {},
        {update: 'moduleAchievementSubjectList'}
    );

    $('createSubjectPanelButton').addEvent('click', function(){
        ION.formWindow(
            'subject_detail',
            'subjectForm',
            Lang.get('module_achievement_label_new_subject'),
            'module/achievement/subject/create',
            {
                width: 350,
                height: 150
            }
        );
    });
</script>