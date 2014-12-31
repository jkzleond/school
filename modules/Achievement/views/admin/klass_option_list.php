<?php foreach($klasses as $klass): ?>
    <option value="<?php echo $klass['id'] ?>" <?php echo $klass['id'] == $selected?'selected':'' ?>><?php echo $klass['name'] ?></option>
<?php endforeach?>