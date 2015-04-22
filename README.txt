=== hideShowPassword ===
Contributors: barryceelen
Requires at least: 3.5.1
Tested up to: 4.2
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Toggle password visibility on the WordPress login screen.

== Description ==

Lets you easily show or hide the contents of the password field on the WordPress login screen. Uses the excellent [hideShowPassword](https://github.com/cloudfour/hideShowPassword) jQuery plugin by the equally excellent [Cloud Four](http://cloudfour.com/).

**Suggested reading:** ["a compendium of why and how to show passwords and what’s coming next"](http://www.lukew.com/ff/entry.asp?1941) by Luke Wroblewski.

= Options =

A settings section is added to the 'General Settings' page. You can select between toggling password visibility via an icon in the password field (default) or via a checkbox below the password field.

= Translations =

The default setting of toggling the password via an icon in the password field does not require translation as no text will be visible to the user. If you select the option of toggling the password via a checkbox, the following translations are included:

* Dutch
* German

= Github =

Fork me on [Github](https://github.com/barryceelen/wp-hide-show-password).

== Installation ==

1. Install hideShowPassword either via the [Plugins Add New Screen](http://codex.wordpress.org/Plugins_Add_New_Screen), or by uploading the files to your server
2. Activate the plugin through the 'Plugins' menu in WordPress

== Screenshots ==

1. Adds an icon to the password field on the login screen.
2. Show your password by clicking the icon.
3. Alternatively, toggle the password via a checkbox labeled "Show Password".

== Changelog ==

= 2.0.0 =

* Adds the option of toggling password visibility via a checkbox below the password field
* Update hideShowPassword.js to version 2.0.4

= 1.0.4 =

* Update hideShowPassword.js to version 2.0.3, fixes [#11](https://github.com/cloudfour/hideShowPassword/issues/11), [#13](https://github.com/cloudfour/hideShowPassword/issues/13)

= 1.0.3 =

* Update hideShowPassword.js to [version 2.0.1](http://blog.cloudfour.com/hideshowpassword-2/), fixes [#10](https://github.com/cloudfour/hideShowPassword/pull/10)

= 1.0.2 =

* Update hideShowPassword.js to version 1.0.3, set touchSupport to true

= 1.0.1 =

* Hide default Internet Explorer 10 control for toggling password visibility

= 1.0.0 =

* Initial version
