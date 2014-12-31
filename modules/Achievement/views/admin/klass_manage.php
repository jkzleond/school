<h2 class="main grades"><?php echo lang('module_achievement_title_class'); ?></h2>
<div class="main subtitle">
    <p><span class="lite">班级的管理</span></p>
</div>
<div id="grades">
    <div class="divider">
        <a class="button light" id="createKlassPanelButton">
            <i class="icon-plus"></i><?= lang('module_achievement_button_create_class') ?>
        </a>
    </div>
    <h3 class="toggler toggler-items expand" title="班级列表">班级列表</h3>
    <div id="moduleAchievementClassList" class="element element-items" style="padding-top: 0px; border-top-style: none; padding-bottom: 0px; border-bottom-style: none; overflow: hidden; height: auto;">

    </div>
</div>
<script type="text/javascript">
    ION.HTML(
        admin_url + 'module/achievement/klass/get_list',
        {},
        {update: 'moduleAchievementClassList'}
    );

    $('createKlassPanelButton').addEvent('click', function(){
        ION.formWindow(
            'klass_detail',
            'klassForm',
            Lang.get('module_achievement_label_new_class'),
            'module/achievement/klass/create',
            {
                width: 350,
                height: 100
            }
        );
    });
</script>