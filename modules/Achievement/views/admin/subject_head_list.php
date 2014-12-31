    <th data-col="student_number"><?php echo lang('module_achievement_label_student_number'); ?></th>
    <th data-col="student_name"><?php echo lang('module_achievement_label_student_name'); ?></th>
<?php foreach($subjects as $key=>$subject): ?>
    <th data-col="subject" data-id="<?php echo $subject['id']; ?>">
        <?php echo $subject['title']; ?>
    </th>
<?php endforeach?>
    <th data-col="total"><?php echo lang('module_achievement_label_total'); ?></th>
    <th data-col="class_rank"><?php echo lang('module_achievement_label_class_rank'); ?></th>
    <th data-col="grade_rank"><?php echo lang('module_achievement_label_grade_rank'); ?></th>
    <th data-col="operation"><?php echo lang('module_achievement_label_operation'); ?></th>
