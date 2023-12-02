/*
 * 	Additional function for editor.html
 *	Written by ThemePixels	
 *	http://themepixels.com/
 *
 *	Built for Amanda Premium Responsive Admin Template
 *  http://themeforest.net/category/site-templates/admin-templates
 */




$(function() {


                $('textarea.tinymce').tinymce({
                        // Location of TinyMCE script
                        script_url : 'http://archive.tinymce.com/js/tinymce_3_x/jscripts/tiny_mce/tiny_mce.js',
                        entity_encoding : "raw",
                        element_format : 'html',
                         inline_styles : true,
                          doctype : "<!DOCTYPE html>",
                           verify_html: false,
                        // General options
                        theme : "advanced",
                        paste_create_paragraphs : false,
paste_create_linebreaks : false,
paste_use_dialog : true,
paste_auto_cleanup_on_paste : true,
paste_convert_middot_lists : false,
paste_unindented_list_class : "unindentedList",
paste_convert_headers_to_strong : true,
paste_insert_word_content_callback : "convertWord",
                        plugins : "fullpage,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

                        // Theme options
                        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
                        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
                        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
                        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
                        theme_advanced_toolbar_location : "top",
                        theme_advanced_toolbar_align : "left",
                        theme_advanced_statusbar_location : "bottom",
                        theme_advanced_resizing : true,
                        fullpage_hide_in_source_view: true,
                        extended_valid_elements : "div[style|class|name|href|target|title|onclick]",
                        // Example content CSS (should be your site CSS)
                        content_css : "css/content.css",
                        
                         //extended_valid_elements : "div[style]",
                        // Drop lists for link/image/media/template dialogs
                        template_external_list_url : "lists/template_list.js",
                        external_link_list_url : "lists/link_list.js",
                        external_image_list_url : "lists/image_list.js",
                        media_external_list_url : "lists/media_list.js",

                        // Replace values for the template plugin
                        template_replace_values : {
                                username : "Some User",
                                staffid : "991234"
                        }
                });
        });


$(document).ready(function() {


		/*$('textarea.tinymce').tinymce({
			// Location of TinyMCE script
			script_url : 'http://archive.tinymce.com/js/tinymce_3_x/jscripts/tiny_mce/tiny_mce.js',

			// General options
			theme : "advanced",
			skin : "themepixels",
			width: "100%",
			plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",
			inlinepopups_skin: "themepixels",
			// Theme options
			theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,outdent,indent,blockquote,formatselect,fontselect,fontsizeselect",
			theme_advanced_buttons2 : "pastetext,pasteword,|,bullist,numlist,|,undo,redo,|,link,unlink,image,help,code,|,preview,|,forecolor,backcolor,removeformat,|,charmap,media,|,fullscreen",
			theme_advanced_buttons3 : "",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,

			// Example content CSS (should be your site CSS)
			content_css : "css/plugins/tinymce.css",

			// Drop lists for link/image/media/template dialogs
			template_external_list_url : "lists/template_list.js",
			external_link_list_url : "lists/link_list.js",
			external_image_list_url : "lists/image_list.js",
			media_external_list_url : "lists/media_list.js",

			// Replace values for the template plugin
			template_replace_values : {
				username : "Some User",
				staffid : "991234"
			}
		});
				*/
		
		$('.editornav a').click(function(){
			$('.editornav li.current').removeClass('current');
			$(this).parent().addClass('current');
			if($(this).hasClass('visual'))
				$('#elm1').tinymce().show();
			else
				$('#elm1').tinymce().hide();
			return false;
		});
});
