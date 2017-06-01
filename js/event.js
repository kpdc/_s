jQuery(document).ready(function($) {
	$('section').hide();
	$('.event').show();

	$('.page-title span').click(function() {
		$('.page-title span').removeClass('active');
		$(this).addClass('active');
	});

	$('#event').click(function() {
		$('section').fadeOut();
		$('.event').fadeIn();
	});

	$('#webinar').click(function() {
		$('section').fadeOut();
		$('.webinar').fadeIn();
	});
});