<h2 class="main grades"><?php echo lang('module_achievement_title_grade'); ?></h2>
<div class="main subtitle">
    <p><span class="lite">年级的管理</span></p>
</div>
<div id="grades">
    <div class="divider">
        <a class="button light" id="createGradePanelButton">
            <i class="icon-plus"></i><?= lang('module_achievement_button_create_grade') ?>
        </a>
    </div>
    <h3 class="toggler toggler-items expand" title="年级列表">年级列表</h3>
    <div id="moduleAchievementGradeList" class="element element-items" style="padding-top: 0px; border-top-style: none; padding-bottom: 0px; border-bottom-style: none; overflow: hidden; height: auto;">

    </div>
</div>
<script type="text/javascript">
    ION.HTML(
        admin_url + 'module/achievement/grade/get_list',
        {},
        {update: 'moduleAchievementGradeList'}
    );

    $('createGradePanelButton').addEvent('click', function(){
        ION.formWindow(
            'grade_detail',
            'gradeForm',
            Lang.get('module_achievement_label_new_grade'),
            'module/achievement/grade/create',
            {
                width: 350,
                height: 100
            }
        );
    });
</script>