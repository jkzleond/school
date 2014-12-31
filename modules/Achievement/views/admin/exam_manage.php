<h2 class="main exams"><?php echo lang('module_achievement_title_exam'); ?></h2>
<div class="main subtitle">
    <p><span class="lite">考次的管理</span></p>
</div>
<div id="exams">
    <div class="divider">
        <a class="button light" id="createExamPanelButton">
            <i class="icon-plus"></i><?= lang('module_achievement_button_create_exam') ?>
        </a>
    </div>
    <h3 class="toggler toggler-items expand" title="考次列表">考次列表</h3>
    <div id="moduleAchievementExamList" class="element element-items" style="padding-top: 0px; border-top-style: none; padding-bottom: 0px; border-bottom-style: none; overflow: hidden; height: auto;">

    </div>
</div>
<script type="text/javascript">
    ION.HTML(
        admin_url + 'module/achievement/exam/get_list',
        {},
        {update: 'moduleAchievementExamList'}
    );

    $('createExamPanelButton').addEvent('click', function(){
        ION.formWindow(
            'exam_detail',
            'examForm',
            Lang.get('module_achievement_label_new_exam'),
            'module/achievement/exam/create',
            {
                width: 350,
                height: 100
            }
        );
    });
</script>