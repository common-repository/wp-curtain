jQuery(document).ready(function ($) {
	var future_date = wpc_settings.future_date,
		disable_timer = parseInt(wpc_settings.disable_timer);

	if (!disable_timer && future_date.date) {
		var currentDate = new Date(),
			futureDateString = future_date.date + ' ' + future_date.hh + ':' + future_date.mm + ':' + future_date.ss,
			timestamp = Date.parse(futureDateString);

		if (isNaN(timestamp)) {
			return;
		}

		var futureDate = new Date(futureDateString);
		var diff = futureDate.getTime() / 1000 - currentDate.getTime() / 1000;
		if (diff < 0) {
			return;
		}

		var $clock = $('.clock');
		if (diff > 86400) {
			$clock.FlipClock(diff, {clockFace: 'DailyCounter', countdown: true});
		}
		else {
			$clock.FlipClock(diff, {countdown: true});
			$clock.css('width', 460);
		}
	}
});

jQuery(document).ready(function ($) {
	$("#login-slide-down").click(function () {
		$("#login-box").slideDown();
		$(this).slideUp();
	});

	$("#login-slide-up").click(function () {
		$("#login-box").slideUp();
		$("#login-slide-down").slideDown();
	});
});