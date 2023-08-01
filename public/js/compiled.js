$(document).ready(function(event) {
	$('#loader').fadeOut();







	$('#remember').click(function(event) {
		$(this).is(':checked') ? $('.password').attr('type', 'text') : $('.password').attr('type', 'password');
	})
});

