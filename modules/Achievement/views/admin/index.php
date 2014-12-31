<div id="maincolumn">

    <h2 class="main achievement"><?php echo lang('module_achievement_title'); ?></h2>

    <div class="main subtitle">

        <!-- About this module -->
        <p class="lite">
            <?php echo lang('module_achievement_about'); ?>
        </p>
    </div>
    <!--  achieveToolbar  -->
    <div class="divider">
        <a id="moduleAchievementCreateAchieveButton" class="button left yellow">
            <i class="icon-plus"></i>
            <?php echo lang('module_achievement_button_create_achieve'); ?>
        </a>
        <!--  grade_filter -->
        <label for="moduleAchievementAchieveGradeFilter"><?php echo lang('module_achievement_label_grade') ?></label>
        <select id="moduleAchievementAchieveGradeFilter"></select>
        <!--  class_filter -->
        <label for="moduleAchievementAchieveKlassFilter">
            <?php echo lang('module_achievement_label_class') ?>
        </label>
        <select id="moduleAchievementAchieveKlassFilter"></select>
        <!-- records per page  -->
        <label for="moduleAchievementAchieveLimitFilter"><?php echo lang('module_achievement_per_page'); ?></label>
        <input id="moduleAchievementAchieveLimitFilter" type="text" class="search number" style="width:30px;height:26px;" value="30">
        <!--  number or name search  -->
        <div id="moduleAchievementAchieveStudentNumberFilter" class="inline-block" style="width:200px; margin-left:100px;height:30px; line-height:30px;">
            <label><?php echo lang('module_achievement_label_student_name').'/'.lang('module_achievement_label_student_number'); ?></label>
            <a class="icon search right" style="margin-top:5px;"></a>
            <input class="search gray-focus right" type="text" style="width:100px;line-height:26px;margin-right:10px;"/>
        </div>
        <!--  exam_filter      -->
        <form action="" class="width-auto float-right">
            <lable for="exam"><?php echo lang('module_achievement_label_exam') ?></lable>
            <select name="exam" id="moduleAchievementAchieveExamFilter" class="css-select">

            </select>
        </form>
    </div>
    <table id="moduleAchievementAchieveTable" class="achieve-table">
        <thead>
            <tr id="moduleAchievementSubjectHeadList"></tr>
        </thead>
        <tbody>
            <tr id="moduleAchievementFeedBox" class="hidden">
                <td data-col="student">
                    <input data-col="student_number" type="text" readonly/>
                    <input data-col="student_id" type="hidden"/>
                </td>
                <td data-col="student">
                    <input data-col="student_name" type="text" readonly/>
                </td>
                <td data-col="total"></td>
                <td data-col="class_rank"></td>
                <td data-col="grade_rank"></td>
                <td data-col="operation">
                    <a class="save icon right"></a>
                </td>
            </tr>
        </tbody>
        <tbody id="moduleAchievementAchieveList" class="row-hover-gray">
        </tbody>
        <tfoot id="moduleAchievementAchievePaginationContainer"></tfoot>
    </table>
</div>

<script type="text/javascript">
(function($,$$,ION){
    //extend
    $(document.body).addEvent('keydown:relay(input[type=text].number)',function(e){
        var key = e.key;
        var allow = /[0-9]|backspace|right|left/;
        if(!allow.test(key))
        {
            e.preventDefault();
            return false;
        }
    });

    ION.append({
        fireEvent: function(){
            $(document).fireEvent.apply($(document), arguments);
        },
        addEvent: function(type, func){
            $(document).addEvent(type, func);
        }
    });

    /* module main */

    ION.initModuleToolbox('achievement', 'main_toolbox');

    ION.HTML(
        admin_url + 'module/achievement/subject/get_list/head',
        {},
        {update: 'moduleAchievementSubjectHeadList'}
    );


    //
    var selected_grade = null;
    var selected_class = null;
    var selected_exam = null;
    var search_term = null;
    var page = 1;
    var limit = 30;


    function get_achieve_list(exam_id, grade_id, class_id, student_number)
    {
        var exam_id = exam_id || selected_exam || 'any';
        var grade_id = grade_id || selected_grade || 'any';
        var class_id = class_id || selected_class || 'any';
        var student_number = student_number || search_term || 'any';

        ION.HTML(
            admin_url + 'module/achievement/achievement/get_list/' + exam_id + '/' + grade_id + '/' + class_id + '/' + student_number + '/' + limit + '/' + page,
            {},
            {
                update:'moduleAchievementAchieveList',
                onSuccess: function(node_list, elements, html){
                    var pagination = $('moduleAchievementAchieveList').getElement('tr[data-col=pagination]');
                    var page_conatiner = $('moduleAchievementAchievePaginationContainer');
                    var old_content = page_conatiner.getElement('td');
                    if(old_content !== null) old_content.destroy();
                    pagination.inject(page_conatiner);
                }
            }
        );
    }

    /* filters  */

    //grade_filter list
    ION.HTML(
        'module/achievement/grade/get_list/option',
        {},
        {
            update: 'moduleAchievementAchieveGradeFilter',
            onSuccess: function(node_list, elements){
                if(selected_grade == null)
                {
                    var def_opt = new Element('option');
                    def_opt.set('text', Lang.get('module_achievement_text_unselected'));
                    def_opt.set('value','');
                    $('moduleAchievementAchieveGradeFilter').grab(def_opt, 'top');
                }
                else
                {
                    $('moduleAchievementAchieveGradeFilter').set('value', selected_grade);
                }
            }
        }
    );

    //class_filter list
    ION.HTML(
        'module/achievement/klass/get_list/option',
        {},
        {
            update: 'moduleAchievementAchieveKlassFilter',
            onSuccess: function(node_list, elements){
                if(selected_class == null)
                {
                    var def_opt = new Element('option');
                    def_opt.set('text', Lang.get('module_achievement_text_unselected'));
                    def_opt.set('value','');
                    $('moduleAchievementAchieveKlassFilter').grab(def_opt, 'top');
                }
                else
                {
                    $('moduleAchievementAchieveKlassFilter').set('value', selected_class);
                }
            }
        }
    );


    //exam_filter list
    ION.HTML(
        admin_url + 'module/achievement/exam/get_list/option',
        {},
        {
            update: 'moduleAchievementAchieveExamFilter',
            onSuccess: function(node_list, elements){
                selected_exam = elements[0].get('value');
                get_achieve_list();
            }
        }
    );

    //filter event
    $$('#moduleAchievementAchieveGradeFilter,#moduleAchievementAchieveKlassFilter,#moduleAchievementAchieveExamFilter').each(function(filter){
        filter.addEvent('change',function(){
            selected_grade = $('moduleAchievementAchieveGradeFilter').get('value');
            selected_class = $('moduleAchievementAchieveKlassFilter').get('value');
            selected_exam = $('moduleAchievementAchieveExamFilter').get('value');
            page = 1;
            get_achieve_list();
        });
    });

    $('moduleAchievementAchieveLimitFilter').addEvent('change', function(e){
        var limit_val = this.get('value');
        limit = limit_val;
        page = 1;
        get_achieve_list();
    });

    //create
    $('moduleAchievementCreateAchieveButton').addEvent('click', function(edit_data){
        var feed_box = $('moduleAchievementFeedBox');
        var is_show = feed_box.retrieve('is_show', false);
        var is_edit = feed_box.retrieve('is_edit', false);
        feed_box.hasClass('hidden') && feed_box.removeClass('hidden');
        if(is_show)
        {
            $('moduleAchievementFeedBox').fade('out');
            feed_box.addClass('hidden');
            feed_box.store('is_show', false);
            this.removeClass('green');
            this.addClass('yellow');
        }
        else
        {
            var total_col = feed_box.getElement('td[data-col=total]');

            $$('#moduleAchievementFeedBox td[data-col=score]').destroy().empty();
            $$('#moduleAchievementSubjectHeadList th').each(function(head){
                var data_col = head.get('data-col');
                if (data_col != 'subject') return;
                var col = new Element('td');
                var data_id = head.get('data-id');
                data_col = 'score';
                col.setProperty('data-id', data_id);
                col.setProperty('data-col', data_col);
                var score_input = new Element('input[type=text].number');
                //if is editing feed score

                is_edit && score_input.set('value', edit_data.scores[data_id]);
                col.grab(score_input);
                col.inject(total_col, 'before');
            });
            if(is_edit)
            {
                feed_box.getElement('[data-col=student_id]').set('value', edit_data.student_id);
                feed_box.getElement('[data-col=student_number]').set('value', edit_data.student_number);
                feed_box.getElement('[data-col=student_name]').set('value', edit_data.student_name);
            }
            feed_box.store('is_edit', false);
            feed_box.store('is_show', true);
            feed_box.fade('in');
            this.removeClass('yellow');
            this.addClass('green');
        }
    });

    //search
    $('moduleAchievementAchieveStudentNumberFilter').getElement('a.search').addEvent('click', function(e){
        var number_or_name = $('moduleAchievementAchieveStudentNumberFilter').getElement('input').get('value');
        search_term = number_or_name;
        page = 1;
        get_achieve_list();
    });

    //feedbox event

    var student_win = null;

    $('moduleAchievementFeedBox').addEvent('click:relay(td[data-col=student])',function(event, clicked){
       student_win = ION.dataWindow(
            'student',
            Lang.get('module_achievement_label_manage_student'),
            'module/achievement/student/manage',
            {
                width:550,
                height:400
            }
        );
    });

    //save
    $('moduleAchievementFeedBox').getElement('a.save').addEvent('click', function(e){
        var feedbox = $('moduleAchievementFeedBox');
        var data = {};
        var student_id = feedbox.getElement('input[data-col=student_id]').get('value');
        var exam_id = $('moduleAchievementAchieveExamFilter').get('value');
        var scores = [];
        feedbox.getElements('[data-col=score]').each(function(score_col){
            var subject_id = score_col.get('data-id');
            var subject_score = score_col.getElement('input').get('value');
            var score = {
                student_id: student_id,
                subject_id: subject_id,
                exam_id: exam_id,
                score: subject_score
            };
            scores.push(score)
        });
        data.scores = scores;
//        console.log(data);
        ION.JSON('module/achievement/achievement/save', data);
    });

    //feed the student data and close student manage window
    $(document).addEvent('feedback', function(feedback){
        if(feedback.type != 'student') return;
        var data = feedback.data;
        $('moduleAchievementFeedBox').getElement('[data-col=student_id]').set('value', data.id);
        $('moduleAchievementFeedBox').getElement('[data-col=student_number]').set('value', data.number);
        $('moduleAchievementFeedBox').getElement('[data-col=student_name]').set('value', data.name);
        student_win != null && student_win.close();
    })

    //edit
    $(document).addEvent('achievement.achieve.edit', function(data_row){
        var feed_box = $('moduleAchievementFeedBox');
        feed_box.store('is_show', false);
        feed_box.store('is_edit', true);
        $('moduleAchievementCreateAchieveButton').fireEvent('click', data_row);
    });

    //pagination event
    ION.addEvent('achievement.achieve.page.change', function(page_num){
        page = page_num;
        get_achieve_list();
    });

    //subject data change event
    ION.addEvent('achievement.subject.data.change', function(e){
        get_achieve_list();
    });

    //achieve data change event
    ION.addEvent('achievement.achieve.data.change', function(e){
        get_achieve_list();
    });

    // column hover
    $('moduleAchievementAchieveTable').addEvent('mouseenter:relay(td[data-col=score])', function(){
        $$('td[data-col=score][data-id=' + this.get('data-id') + ']').each(function(col){col.addClass('hover')});
    });
    $('moduleAchievementAchieveTable').addEvent('mouseleave:relay(td[data-col=score])', function(){
        $$('td[data-col=score][data-id=' + this.get('data-id') + ']').each(function(col){col.removeClass('hover')});
    });

})(document.id,$$,ION);
</script>