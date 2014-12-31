<?php foreach($exams as $exam): ?>
    <option value="<?php echo $exam['id'] ?>" <?php echo $exam['id'] == $selected?'selected':'' ?>><?php echo $exam['start_date'].':'.$exam['name']; ?></option>
<?php endforeach?>