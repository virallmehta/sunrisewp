(function() {
	tinymce.PluginManager.add('artooz_mce_button', function( editor, url ) {
		editor.addButton('artooz_mce_button', {
			icon: false,
			image : url + '/../images/ar-shortcode.png',
			type: 'menubutton',
			menu: [
				{
					text: 'Button',
					onclick: function() {
						editor.insertContent('[button href="" target="" css_classes="yellow"]content[/button]');
					}
				},
				{
					text: 'Heading',
					onclick: function() {
						editor.insertContent('[heading class="classname"]content[/heading]');
					}
				},
				{
					text: 'Icon',
					onclick: function() {
						editor.insertContent('[icon icon="fa-heart" color="yellow" size="large" style="circle" class="classname"][/icon]');
					}
				},
				{
					text: 'Text Box',
					onclick: function() {
						editor.insertContent('[text_box title="Title"]content[/text_box]');
					}
				},
				{
					text: 'List Item',
					onclick: function() {
						editor.insertContent('[checklist type="checked, dotted, arrowed" margin_bottom="no"]<ul class="checked">\r<li>List Item #1</li>\r<li>List Item #2</li>\r<li>List Item #3</li>\r</ul>[/checklist]');
					}
				},
				{
					text: 'YouTube',
					onclick: function() {
						editor.insertContent('[youtube url="" width="" height=""]');
					}
				},
				{
					text: 'Vimeo',
					onclick: function() {
						editor.insertContent('[vimeo url="" width="" height=""]');
					}
				},
			]
		});
	});
})();