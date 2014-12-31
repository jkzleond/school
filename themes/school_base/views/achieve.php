<ion:partial view="header" />
<!-------------------------正文左边部分开始------------------------------------------>
<div id="sub-main">
    <ion:partial view="page_header" />
    <div class="cjcx"><h2>会泽县茚旺高级中学成绩在线查询</h2>
        <div class="cjcx-left">

            <p>姓名<input id="studentName" class="input-03" type="text"/></p><p>考号<input id="studentNumber" class="input-03 number" type="text"/></p><p><input id="achieveQueryButton" class="cjcx-an" type="button" value="提交查询"/></p>
        </div>
        <div id="messageContainer" class="left" style="width:200px;height:100px;margin:50px; text-align: center; color:red;">
            <div style="height:30px;position: relative; top:60px;">
                <span class="error-message" style="display: none;">
                    查询错误
                </span>
            </div>
            <div>
                <span class="loading" style="display: none"></span>
            </div>
        </div>
        <div class="cjcx-right">
            <ion:articles:article:content limit="1" />
        </div>
        <div class="clear"></div>
        <div>
            <span class="left">
                <label for="examFilter" style="font-size:14px;">考次</label>
                <select id="examFilter">
                    <option value="0">
                        没有考试成绩
                    </option>
                </select>
            </span>
        </div>
        <div class="cjcx-table" style="margin-top:20px;">
            <table id="achieveList" width="0" border="0" cellspacing="0" cellpadding="0">
                <tr id="achieveHead">
                    <td data-col="student_name" width="130">姓名</td>
                    <td data-col="student_number" width="150">考号</td>
                    <td data-col="total" width="100">总成绩</td>
                    <td data-col="class_rank" width="90">班级排名</td>
                    <td data-col="grade-rank" width="90">年级排名</td>
                </tr>
                <tr id="achieveScore" style="display:none;">
                    <td data-col="student_name">&nbsp;</td>
                    <td data-col="student_number">&nbsp;</td>
                    <td data-col="total">&nbsp;</td>
                    <td data-col="class_rank">&nbsp;</td>
                    <td data-col="grade_rank">&nbsp;</td>
                </tr>
            </table>

        </div>
    </div>
</div>
<script type="text/javascript">
    $('input.number').live('keydown',function(e){
        if((e.keyCode < 48 || e.keyCode > 57) && e.keyCode != 37 && e.keyCode != 39 && e.keyCode != 8)
        {
            e.preventDefault();
        }
    });
    (function($,document){
        var subject_url = '/achievement/subject'
        var exam_url = '/achievement/exam';
        var achieve_url = '/achievement/';
        var flag = 0;

        //global ajax event callback
        $.ajaxSetup({
            beforeSend: function(){
                $('#messageContainer .loading').fadeIn(300);
            },
            complete: function(){
                $('#messageContainer .loading').fadeOut(800);
            },
            error: function(){
                $('#messageContainer .error-message').text('数据查询错误').delay(800).fadeIn(500).fadeOut(1500);
                $('#achieveScore').hide();
            }
        });

        //get subject
        $.getJSON(subject_url, function(subjects){
            var total_col = $('#achieveHead [data-col=total]');
            while(subjects.length !== 0)
            {
                var subject = subjects.shift();
                var subject_col = $('<td width="70"></td>');
                subject_col
//                .attr('data-col','subject')
//                .attr('data-id',subject.id)
                    .text(subject.title)
                    .insertBefore(total_col);
            }
            flag++;
        });
        //get exam
        $.getJSON(exam_url, function(exams){
            if(exams.length != 0) flag++;
            var exam_filter = $('#examFilter');
            exam_filter.empty();
            var len = exams.length;
            for(var i = 0; i < len; i++)
            {
                var exam = exams[i];
                var opt = $('<option></option>');
                opt.val(exam.id)
                    .text(exam.start_date + ':' + exam.name)
                    .appendTo(exam_filter);
            }
        });

        //query button click
        $('#achieveQueryButton').click(function(e){
            if(flag < 2) return false;
            var exam_id = $('#examFilter').val();
            var student_number = $('#studentNumber').val();
            var student_name = $('#studentName').val();
            get_achieve_list(student_number, student_name, exam_id);
        });

        function get_achieve_list(student_number, student_name, exam_id)
        {
            var params = Array.prototype.join.call(arguments, '/');
//            console.log(achieve_url + params);
            $.ajax({
                url: achieve_url + params,
                dataType: 'json',
                beforeSend: function(){
                    //prevent of the global setting being overriden
                    $.ajaxSettings.beforeSend();
                    $('#achieveQueryButton').attr('disabled', 'disabled');
                },
                complete: function(){
                    //prevent of the global setting being overriden
                    $.ajaxSettings.complete();
                    $('#achieveQueryButton').removeAttr('disabled');
                },
                success: function(achieves){
                    if(achieves.length == 0)
                    {
                        $('#messageContainer .error-message').text('没有该考生成绩')
                            .delay(800).fadeIn(500).fadeOut(2000);
                        $('#achieveScore').hide();
                        return;
                    }
                    //clear old data
                    $('[data-col=score]').remove();

                    var achieve = achieves[0];
                    var name_col = $('#achieveScore [data-col=student_name]');
                    var number_col = $('#achieveScore [data-col=student_number]');
                    var total_col = $('#achieveScore [data-col=total]');
                    var grade_rank = $('#achieveScore [data-col=grade_rank]');
                    var class_rank = $('#achieveScore [data-col=class_rank]');
                    var scores = achieve.scores;
                    while(scores.length !== 0)
                    {
                        var score = scores.shift();
                        var score_col = $('<td></td>');
                        score_col.attr('data-col', 'score')
                            .attr('data-id',score.subject_id)
                            .text(score.score);
                        score_col.insertBefore(total_col);
                    }
                    name_col.text(achieve.student_name);
                    number_col.text(achieve.student_number);
                    total_col.text(achieve.total);
                    grade_rank.text(achieve.grade_rank);
                    class_rank.text(achieve.class_rank);
                    $('#achieveScore').fadeIn(500);
                }
            });
        }


    })(jQuery,document);
</script>
<ion:partial view="footer" />