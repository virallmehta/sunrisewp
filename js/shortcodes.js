(function() {  
    tinymce.create('tinymce.plugins.Shikha_button', {  
        init : function(ed, url) {  
            ed.addButton('sh_button', {  
                title : 'Add a Button Link',  
                image : url+'/../images/shortcode_icons/button_link.png',  
                onclick : function() {  
                     ed.selection.setContent('[button href="" target="" css_classes="btn-yellow"]' + ed.selection.getContent() + '[/button]');  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('sh_button', tinymce.plugins.Shikha_button);  
})();  

(function() {  
	tinymce.create('tinymce.plugins.Shikha_heading', {  
		init : function(ed, url) {  
			ed.addButton('heading', {  
				title : 'Add a Heading',  
				image : url+'/../images/shortcode_icons/heading.png',  
				onclick : function() {
					ed.selection.setContent('[heading class="classname"]' + ed.selection.getContent() + '[/heading]');
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		},
	});
	tinymce.PluginManager.add('heading', tinymce.plugins.Shikha_heading);
})();

(function() {  
    tinymce.create('tinymce.plugins.Shikha_icon', {  
        init : function(ed, url) {  
            ed.addButton('icon', {  
                title : 'Add an Icon',  
                image : url+'/../images/shortcode_icons/icon.png',  
                onclick : function() {  
                     ed.selection.setContent('[icon icon="fa-heart" color="yellow" size="large" style="circle" class="classname"][/icon]');  
  
                }  
            });  
        },  
        createControl : function(n, cm) {  
            return null;  
        },  
    });  
    tinymce.PluginManager.add('icon', tinymce.plugins.Shikha_icon);  
})();

(function() {  
 tinymce.create('tinymce.plugins.Shikha_youtube', {  
     init : function(ed, url) {  
         ed.addButton('youtube', {  
             title : 'Add a Youtube video',  
			 image : url+'/../images/shortcode_icons/youtube.png', 
             onclick : function() {  
                  ed.selection.setContent('[youtube id="DjW3DE6Lq4s"]');  

             }  
         });  
     },  
     createControl : function(n, cm) {  
         return null;  
     },  
 });  
 tinymce.PluginManager.add('youtube', tinymce.plugins.Shikha_youtube);  
})();


(function() {  
 tinymce.create('tinymce.plugins.Shikha_vimeo', {  
     init : function(ed, url) {  
         ed.addButton('vimeo', {  
             title : 'Add a Vimeo video',  
             image : url+'/../images/shortcode_icons/vimeo.png', 
             onclick : function() {  
                  ed.selection.setContent('[vimeo id="10145153"]');  

             }  
         });  
     },  
     createControl : function(n, cm) {  
         return null;  
     },  
 });  
 tinymce.PluginManager.add('vimeo', tinymce.plugins.Shikha_vimeo);  
})();

(function() {  
	tinymce.create('tinymce.plugins.Shikha_text_box', {  
		init : function(ed, url) {  
			ed.addButton('text_box', {  
				title : 'Add a Text Box',  
				image : url+'/../images/shortcode_icons/text_box.png',  
				onclick : function() {
					ed.selection.setContent('[text_box title="Text Box Title"][/text_box]');
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		},
	});
	tinymce.PluginManager.add('text_box', tinymce.plugins.Shikha_text_box);
})();


(function() {  
    tinymce.create('tinymce.plugins.Shikha_checklist', {  
        init : function(ed, url) {  
        ed.addButton('checklist', {  
            title : 'Add a List',  
            image : url+'/../images/shortcode_icons/ul.png',  
            onclick : function() {
                ed.selection.setContent('[checklist type="eg. checked, dotted, arrowed" margin_bottom="no"]<ul class="checked">\r<li>List Item #1</li>\r<li>List Item #2</li>\r<li>List Item #3</li>\r</ul>[/checklist]');
            }
        });
    },
    createControl : function(n, cm) {
        return null;
    },
    });
    tinymce.PluginManager.add('checklist', tinymce.plugins.Shikha_checklist);
})();


