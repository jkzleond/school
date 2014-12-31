
<?php foreach($achieves['data'] as $achieve): ?>
    <tr data-id="<?php echo $achieve['exam_id'].'/'.$achieve['student_id'] ?>">
        <td data-col="student_number"><?php echo $achieve['student_number']; ?></td>
        <td data-col="student_name"><?php echo $achieve['student_name']; ?></td>
        <?php foreach($achieve['scores'] as $score): ?>
        <td data-id="<?php echo $score['subject_id'] ?>" data-score="<?php echo $score['score'] ?>" data-col="score">
            <?php echo $score['score'] ?>
        </td>
        <?php endforeach?>
        <td data-col="total">
            <?php echo isset($achieve['total'])?$achieve['total']:'' ?>
        </td>
        <td data-col="class_rank">
            <?php echo isset($achieve['class_rank'])?$achieve['class_rank']:'' ?>
        </td>
        <td data-col="grade_rank">
            <?php echo isset($achieve['grade_rank'])?$achieve['grade_rank']:'' ?>
        </td>
        <td data-col="operation" data-id="<?php echo $achieve['exam_id'].'/'.$achieve['student_id'] ?>">
            <a class="delete icon right"></a>
            <a class="edit icon right"></a>
        </td>
    </tr>
<?php endforeach?>
<?php
    $counts = !empty($achieves)?$achieves['counts']:0;
    $page_count = ceil($counts/$limit);
?>
<tr data-col="pagination" data-counts="<?php echo $counts; ?>">
    <td colspan="100">
        <span id="moduleAchievementAchievePagination" class="left">
            <?php for($i = 1; $i <= $page_count && $page_count > 1; $i++): ?>
                <a class="<?php echo $i==$page?'active ':''; ?> page"><?php echo $i; ?></a>
            <?php endfor ?>
        </span>
        <span class="right">
            <?php printf(lang('module_achievement_records_number'),$counts); ?>
        </span>
    </td>
</tr>


<script type="text/javascript">
    $$('[data-col=operation] a.edit').each(function(edit){
        edit.addEvent('click', function(e){
            var data_row = edit.getParent('tr[data-id]');
            var ids = data_row.get('data-id').split('/');
            var exam_id = ids[0];
            var student_id = ids[1];
            var student_number = data_row.getElement('[data-col=student_number]').get('text');
            var student_name = data_row.getElement('[data-col=student_name]').get('text');
            var scores = {};
            data_row.getElements('[data-col=score]').each(function(score_col){
                var subject_id = score_col.get('data-id');
                var score = score_col.get('data-score');
                scores[subject_id] = score;
            });
            $(document).fireEvent('achievement.achieve.edit', {
                exam_id: exam_id,
                student_id: student_id,
                student_number: student_number,
                student_name: student_name,
                scores: scores
            });
        });
    });

    //delete achieve
    $$('[data-col=operation][data-id]').each(function(col_operation){
        var del = col_operation.getElement('a.delete');
        var del_ids = col_operation.get('data-id');
        ION.initRequestEvent(
            del,
            admin_url + 'module/achievement/achievement/delete/' + del_ids,
            {},
            {
                confirm: true,
                message: Lang.get('ionize_confirm_element_delete')
            }
        );
    });

    //pagination
    $('moduleAchievementAchievePagination').getElements('a').each(function(page){
        page.addEvent('click',function(e){
            var page_num = page.get('text');
            ION.fireEvent('achievement.achieve.page.change', page_num);
        });
    });
</script>