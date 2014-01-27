(function ($) {
	"use strict";
	$(function () {
		var hasTouch = false;
		if ( ('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch ) {
			hasTouch = true;
		}
		$('#user_pass').hideShowPassword({
			// Creates a wrapper and toggle element with minimal styles.
			innerToggle: true,
			touchSupport: hasTouch
		});
	});
}(jQuery));
