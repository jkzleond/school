
<script type="text/javascript">

	// Empty toolbox
	ION.getToolbox();

	var splitItemPanel = function(title)
	{
		if ($('mainPanel'))
		{
			// Collapse / Expanded status from cookie
			var isCollapsed = false;

			/*
			var opened = Cookie.read('sidecolumn');
			if (typeOf(opened) != 'null' && opened == 'falDOMEventse')
			isCollapsed = true;
			*/

			MUI.Content.update({
				element: 'mainPanel',
				title: title,
				clear:true,
				loadMethod:'control',
				controls:[
					{
						control:'MUI.Column',
						container: 'mainPanel',
						id: 'splitPanel_mainColumn',
						placement: 'main',
						sortable: false,
						panels:[
							{
								control:'MUI.Panel',
								id: 'splitPanel_mainPanel',
								container: 'splitPanel_mainColumn',
								header: false,
								cssClass:'cyclePanel',
								content: {
									url: ION.adminUrl + 'item/welcome'
								}
							}
						]
					},
					{
						control:'MUI.Column',
						container: 'mainPanel',
						id: 'splitPanel_sideColumn',
						placement: 'right',
						sortable: false,
						isCollapsed: isCollapsed,
						width: 300,
						resizeLimit: [200, 400],
						panels:[
							{
								control:'MUI.Panel',
								header: true,
								'title': Lang.get('ionize_title_static_items_definitions'),
								id: 'splitPanel_definition',
								cssClass: 'panelAlt',
								content: [
									{url: ION.adminUrl + 'item_definition/get_list'},
									{
										name: 'new',
										position: 'header',
										url: ION.adminUrl + 'desktop/get/item/definition/toolbox',
										onLoaded: function() {}
									}
								]
							}
						]
					}
				]
			});
		}
	};

	splitItemPanel(Lang.get('ionize_title_static_items'));

</script>