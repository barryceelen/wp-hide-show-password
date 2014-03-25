(function ($) {
	"use strict";
	$(function () {
		var bool = false;
		if ( ('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch ) {
			bool = true;
		}
		$('#user_pass').hideShowPassword(false, true, {
			toggle: {
				touchSupport: bool
			}
		});
	});
}(jQuery));
