$(function() {

	// Enable popover everywhere
	$('[data-toggle="popover"]').popover({
  		trigger: 'focus'
	});

	// Mood Modal
	$('#moodmodal').modal({
		backdrop: 'static',
		keyboard: false
	}, 'show');

	// Scroll to top of the page
	$("#ScrollToTop").click(function() {
		$("html, body").animate({ scrollTop: 0 }, "slow");
		return false;
	});

	// $("#chmessageboard").animate({ $("#chmessageboard").scrollTop() + $("#chmessageboard").height() }, "slow");

});