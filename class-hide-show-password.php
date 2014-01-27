<?php
/**
 * hideShowPassword.
 *
 * @package   Hide_Show_Password
 * @author    Barry Ceelen <b@rryceelen.com>
 * @license   GPL-2.0+
 * @link      https://github.com/barryceelen/wp-hide-show-password
 * @copyright 2013 Barry Ceelen
 */

/**
 * Plugin class.
 *
 * @package Hide_Show_Password
 * @author  Barry Ceelen <b@rryceelen.com>
 */
class Hide_Show_Password {

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   1.0.0
	 *
	 * @var     string
	 */
	const VERSION = '1.0.2';

	/**
	 * Unique identifier.
	 *
	 * The variable name is used as the text domain when internationalizing strings of text.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_slug = 'hide-show-password';

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Initialize the plugin by adding actions.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

		// Load login screen style sheet and JavaScript.
		add_action( 'login_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'login_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

	}

	/**
	 * Register and enqueue login screen style sheet.
	 *
	 * @since     1.0.0
	 *
	 */
	public function enqueue_styles() {
		wp_enqueue_style(
			$this->plugin_slug .'-login-styles',
			plugins_url( 'css/public.css', __FILE__ ),
			array(),
			self::VERSION
		);
	}

	/**
	 * Register and enqueue login screen JavaScript.
	 *
	 * @since     1.0.0
	 *
	 */
	public function enqueue_scripts() {

		wp_register_script(
			'hide-show-password',
			plugins_url( 'js/vendor/hideShowPassword.min.js', __FILE__ ),
			array( 'jquery' ),
			self::VERSION
		);

		wp_enqueue_script(
			$this->plugin_slug . '-login-script',
			plugins_url( 'js/public.js', __FILE__ ),
			array( 'jquery', 'hide-show-password' ),
			self::VERSION
		);
	}
}
