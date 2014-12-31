<h2 class="main students"><?php echo lang('module_achievement_title_student'); ?></h2>
<div class="main subtitle">
    <p><span class="lite">考生的管理:双击项目即可回信息</span></p>
</div>
<div id="students">
    <div class="divider">
        <a class="button light" id="createStudentPanelButton">
            <i class="icon-plus"></i><?= lang('module_achievement_button_create_student') ?>
        </a>
        <!--  grade_filter -->
        <label for="moduleAchievementStudentGradeFilter"><?php echo lang('module_achievement_label_grade') ?></label>
        <select id="moduleAchievementStudentGradeFilter"></select>
        <!--  class_filter -->
        <label for="moduleAchievementStudentKlassFilter">
            <?php echo lang('module_achievement_label_class') ?>
        </label>
        <select id="moduleAchievementStudentKlassFilter"></select>
        <!--  number or name search  -->
        <div id="moduleAchievementStudentNumberFilter" class="right" style="width:120px;">
            <input class="input" type="text" style="width:100px;border:1px solid #ddd;"/>
            <a class="icon search right"></a>
        </div>
    </div>
    <h3 class="toggler toggler-items expand" title="考生列表">考生列表</h3>
    <div id="moduleAchievementStudentList" class="element element-items" style="padding-top: 0px; border-top-style: none; padding-bottom: 0px; border-bottom-style: none; overflow: hidden; height: auto;">

    </div>
</div>
<script type="text/javascript">
    (function($,$$,ION){

        var selected_grade = null;
        var selected_class = null;
        var search_term = null;

        ION.HTML(
            'module/achievement/grade/get_list/option',
            {},
            {
                update: 'moduleAchievementStudentGradeFilter',
                onSuccess: function(node_list, elements){
                    if(selected_grade == null)
                    {
                        var def_opt = new Element('option');
                        def_opt.set('text', Lang.get('module_achievement_text_unselected'));
                        def_opt.set('value','');
                        $('moduleAchievementStudentGradeFilter').grab(def_opt, 'top');
                    }
                    else
                    {
                        $('moduleAchievementStudentGradeFilter').set('value', selected_grade);
                    }
                }
            }
        );

        ION.HTML(
            'module/achievement/klass/get_list/option',
            {},
            {
                update: 'moduleAchievementStudentKlassFilter',
                onSuccess: function(node_list, elements){
                    if(selected_class == null)
                    {
                        var def_opt = new Element('option');
                        def_opt.set('text', Lang.get('module_achievement_text_unselected'));
                        def_opt.set('value','');
                        $('moduleAchievementStudentKlassFilter').grab(def_opt, 'top');
                    }
                    else
                    {
                        $('moduleAchievementStudentKlassFilter').set('value', selected_class);
                    }
                }
            }
        );

        function get_student_list(grade_id, class_id, student_number){
            var grade_id = grade_id || selected_grade || 'any';
            var class_id = class_id || selected_class || 'any';
            var student_number = student_number || search_term || 'any';

            ION.HTML(
                admin_url + 'module/achievement/student/get_list/' + grade_id + '/' + class_id + '/' + student_number,
                {},
                {update: 'moduleAchievementStudentList'}
            );
        };

        get_student_list();


        $('createStudentPanelButton').addEvent('click', function(){
            ION.formWindow(
                'student_detail',
                'studentForm',
                Lang.get('module_achievement_label_new_student'),
                'module/achievement/student/create',
                {
                    width: 350,
                    height: 300
                }
            );
        });

        //filter
        $$('#moduleAchievementStudentGradeFilter,#moduleAchievementStudentKlassFilter').each(function(filter){
            filter.addEvent('change',function(){
                var grade_id = $('moduleAchievementStudentGradeFilter').get('value');
                var klass_id = $('moduleAchievementStudentKlassFilter').get('value');
                selected_grade = grade_id;
                selected_class = klass_id;
                get_student_list();
            });
        });

        //search
        $('moduleAchievementStudentNumberFilter').getElement('a.search').addEvent('click', function(e){
           var number_or_name = $('moduleAchievementStudentNumberFilter').getElement('input').get('value');
            search_term = number_or_name;
            get_student_list();
        });

        //student data change listener
        $(document).addEvent('achievement.student.data.change', function(e){
            get_student_list();
        });
    })(document.id,$$,ION);
</script>