<ul class="gradesPanelList list pb15 pl15">
    <?php foreach($grades as $grade): ?>
        <li class="list pointer" data-id="<?php echo $grade['id']; ?>">
            <a class="left title unselectable"><?php echo $grade['name']; ?></span></a>
            <a class="icon delete right"></a>
            <a class="icon edit right"></a>
        </li>
    <?php endforeach?>
</ul>

<script type="text/javascript">
    $$('.gradesPanelList li').each(function(item){
        var grade_id = item.getProperty('data-id');
        var del_btn = item.getElement('a.delete');
        var edit_btn = item.getElement('a.edit');

        ION.initRequestEvent(
            del_btn,
            admin_url + 'module/achievement/grade/delete/' + grade_id,
            {},
            {
                confirm: true,
                message: Lang.get('ionize_confirm_element_delete')
            }
        );

        edit_btn.removeEvent('click');
        edit_btn.addEvent('click', function(e){
            ION.formWindow(
                'grade_detail',
                'gradeForm',
                Lang.get('module_achievement_label_edit_exam'),
                'module/achievement/grade/edit/' + grade_id,
                {
                    width: 350,
                    height: 100
                }
            );
        });
    });
</script>