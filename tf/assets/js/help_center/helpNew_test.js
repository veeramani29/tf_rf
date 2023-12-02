$(function() {

$('.get_content').on('click', function(){
	url = $(this).attr('href');

	loadContent(url);
	return false;
})
});


function loadContent(url) {
	$('#contentLoad').load(url+' #contentLink', function(r) {
		console.log(r);
	});
}