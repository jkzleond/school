<?php foreach($grades as $grade): ?>
    <option value="<?php echo $grade['id'] ?>" <?php echo $grade['id'] == $selected?'selected':'' ?>><?php echo $grade['name'] ?></option>
<?php endforeach?>