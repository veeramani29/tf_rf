$.validator.setDefaults({
	submitHandler: function() {
		alert("submitted!");
	}
});
$().ready(function() {
	$("#registration").validate();
});