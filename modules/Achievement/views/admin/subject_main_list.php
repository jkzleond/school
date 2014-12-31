<ul class="subjectsPanelList list pb15 pl15">
    <?php foreach($subjects as $subject): ?>
        <li class="list pointer" data-id="<?php echo $subject['id']; ?>">
            <a class="left title unselectable"><?php echo $subject['title']; ?><span class="left">[<?php echo $subject['name']; ?>]</span></a>
            <a class="icon delete right"></a>
            <a class="icon edit right"></a>
        </li>
    <?php endforeach?>
</ul>

<script type="text/javascript">
    $$('.subjectsPanelList li').each(function(item){
        var subject_id = item.getProperty('data-id');
        var del_btn = item.getElement('a.delete');
        var edit_btn = item.getElement('a.edit');

        ION.initRequestEvent(
            del_btn,
            admin_url + 'module/achievement/subject/delete/' + subject_id,
            {},
            {
                confirm: true,
                message: Lang.get('ionize_confirm_element_delete')
            }
        );

        edit_btn.removeEvent('click');
        edit_btn.addEvent('click', function(e){
            ION.formWindow(
                'subject_detail',
                'subjectForm',
                Lang.get('module_achievement_label_edit_subject'),
                'module/achievement/subject/edit/' + subject_id,
                {
                    width: 350,
                    height: 100
                }
            );
        });
    });
</script>