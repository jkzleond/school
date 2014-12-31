<ul class="studentsPanelList list pb15 pl15">
    <?php foreach($students as $student): ?>
        <li class="list pointer" data-id="<?php echo $student['id']; ?>" data-name="<?php echo $student['name']?>" data-number="<?php echo $student['number'] ?>">
            <a class="left title unselectable"><?php echo $student['name']; ?><span class="left">[<?php echo $student['number']; ?>]</span></a>
            <a class="icon delete right"></a>
            <a class="icon edit right"></a>
        </li>
    <?php endforeach?>
</ul>

<script type="text/javascript">
    $$('.studentsPanelList li').each(function(item){
        var student_id = item.getProperty('data-id');
        var del_btn = item.getElement('a.delete');
        var edit_btn = item.getElement('a.edit');

        ION.initRequestEvent(
            del_btn,
            admin_url + 'module/achievement/student/delete/' + student_id,
            {},
            {
                confirm: true,
                message: Lang.get('ionize_confirm_element_delete')
            }
        );

        edit_btn.removeEvent('click');
        edit_btn.addEvent('click', function(e){
            ION.formWindow(
                'student_detail',
                'studentForm',
                Lang.get('module_achievement_label_edit_student'),
                'module/achievement/student/edit/' + student_id,
                {
                    width: 350,
                    height: 150
                }
            );
        });

        item.addEvent('dblclick', function(e){
            var data = {};
            data.id = this.get('data-id');
            data.number = this.get('data-number');
            data.name = this.get('data-name');
            var feedback = {
                type: 'student',
                data: data
            };
            $(document).fireEvent('feedback', feedback);
        });
    });
</script>


