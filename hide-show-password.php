<?php
/**
 * @package   Hide_Show_Password
 * @author    Barry Ceelen <b@rryceelen.com>
 * @license   GPL-2.0+
 * @link      https://github.com/barryceelen/wp-hide-show-password
 * @copyright 2013 Barry Ceelen
 *
 * @wordpress-plugin
 * Plugin Name: hideShowPassword
 * Plugin URI:  https://github.com/barryceelen/wp-hide-show-password
 * Description: Toggle password visibility on the WordPress login screen.
 * Version:     1.0.3
 * Author:      Barry Ceelen
 * Author URI:  https://github.com/barryceelen
 * Text Domain: hide-show-password
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once( plugin_dir_path( __FILE__ ) . 'class-hide-show-password.php' );
add_action( 'plugins_loaded', array( 'Hide_Show_Password', 'get_instance' ) );
