/**
 * Main plugin file
 *
 * @package   Hide_Show_Password
 * @author    Barry Ceelen <b@rryceelen.com>
 * @license   GPL-2.0+
 * @link      https://github.com/barryceelen/wp-hide-show-password
 * @copyright 2013 Barry Ceelen
 */

(function ($) {
	'use strict';
	$(function () {

		var el = $( 'input[type="password"]' );
		var innerToggle = ( 1 == hideShowPasswordVars.innerToggle ) ? true : false;
		var enableTouchSupport = false;

		if ( ( 'ontouchstart' in window ) || window.DocumentTouch && document instanceof DocumentTouch ) {
			enableTouchSupport = true;
		}

		el.hideShowPassword( false, innerToggle, {
			toggle: {
				touchSupport: enableTouchSupport
			}
		});

		if ( false == innerToggle ) {

			var checkbox = $( '<label class="hideShowPassword-checkbox"><input type="checkbox" /> ' + hideShowPasswordVars.checkboxLabel + '</label>' ).insertAfter( el.parent( 'label' ) );

			checkbox.on( 'change.hideShowPassword', 'input[type="checkbox"]', function() {
				el.togglePassword().focus();
			})
		}
	});
}(jQuery));
