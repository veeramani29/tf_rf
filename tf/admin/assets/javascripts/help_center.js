/*
* @author: Vikas Arora
* @Desc: Clones and provide infinite link add module to help center in admin panel.
*/
$('.confirm_add').hide();
$('#linkForm').on('submit', function(e) {
	e.preventDefault();
	var title = $('.cloneSection:last .linkTitle').val();
	var heading = $('.cloneSection:last .heading').val();
	
	var content = CKEDITOR.instances.con_link.getData()
	var menu_id = $('#menu_id').val();
	var sub_id = $('#sub_id').val();
	var content_type = $('.content_type').val();

	var url = $(this).attr("action");

	$.ajax({
		url: url+'/1',
		method: 'POST',
		data: {content_type: content_type, title:title, heading:heading, link_content:content, menu_id: menu_id, sub_id: sub_id},
		success: function(r) {
			
			if(r == 'LINK_SUCCESS') {
				iframe_content_head = $('.cloneSection:last iframe').contents().find('head');  //update the WYSIHTML5 editor's iframe
				iframe_content_body = $('.cloneSection:last iframe').contents().find('body');  //update the WYSIHTML5 editor's iframe
				
				$('.cloneSection:last').clone(true, true).appendTo('#cont3');
				$('.cloneSection:last iframe').contents().find('head').remove();
				$('.cloneSection:last iframe').contents().find('html').append(iframe_content_head);

				$('.cloneSection:last iframe').contents().find('body').remove();
				$('.cloneSection:last iframe').contents().find('head').after(iframe_content_body); /*append the document inside iframe*/

				$('.cloneSection:not(:last)').fadeOut();
				$('.confirm_add').fadeIn();
				clearinputbox();

				$('html, body').animate({scrollTop: $(".row").offset().top}, 800);
			}
		}
	});
});

// function fadeOlderForm


function clearinputbox() {
	$('.cloneSection:last').find('input:text').val("");
	$('.cloneSection:last iframe').contents().find('body').empty();
}