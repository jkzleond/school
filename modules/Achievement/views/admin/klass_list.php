<ul class="classsPanelList list pb15 pl15">
    <?php foreach($klasses as $klass): ?>
        <li class="list pointer" data-id="<?php echo $klass['id']; ?>">
            <a class="left title unselectable"><?php echo $klass['name']; ?></a>
            <a class="icon delete right"></a>
            <a class="icon edit right"></a>
        </li>
    <?php endforeach?>
</ul>

<script type="text/javascript">
    $$('.classsPanelList li').each(function(item){
        var class_id = item.getProperty('data-id');
        var del_btn = item.getElement('a.delete');
        var edit_btn = item.getElement('a.edit');

        ION.initRequestEvent(
            del_btn,
            admin_url + 'module/achievement/klass/delete/' + class_id,
            {},
            {
                confirm: true,
                message: Lang.get('ionize_confirm_element_delete')
            }
        );

        edit_btn.removeEvent('click');
        edit_btn.addEvent('click', function(e){
            ION.formWindow(
                'klass_detail',
                'klassForm',
                Lang.get('module_achievement_label_edit_class'),
                'module/achievement/klass/edit/' + class_id,
                {
                    width: 350,
                    height: 100
                }
            );
        });
    });
</script>