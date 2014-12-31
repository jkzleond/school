<ul class="examsPanelList list pb15 pl15">
    <?php foreach($exams as $exam): ?>
        <li class="list pointer" data-id="<?php echo $exam['id']; ?>">
            <a class="left title unselectable"><?php echo $exam['name']; ?><span class="date">[<?php echo $exam['start_date']; ?>]</span></a>
            <a class="icon delete right"></a>
            <a class="icon edit right"></a>
        </li>
    <?php endforeach?>
</ul>

<script type="text/javascript">
    $$('.examsPanelList li').each(function(item){
        var exam_id = item.getProperty('data-id');
        var del_btn = item.getElement('a.delete');
        var edit_btn = item.getElement('a.edit');

        ION.initRequestEvent(
            del_btn,
            admin_url + 'module/achievement/exam/delete/' + exam_id,
            {},
            {
                confirm: true,
                message: Lang.get('ionize_confirm_element_delete')
            }
        );

        edit_btn.removeEvent('click');
        edit_btn.addEvent('click', function(e){
            ION.formWindow(
                'exam_detail',
                'examForm',
                Lang.get('module_achievement_label_edit_exam'),
                'module/achievement/exam/edit/' + exam_id,
                {
                    width: 350,
                    height: 100
                }
            );
        });
    });
</script>


