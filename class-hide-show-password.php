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
	const VERSION = '2.0.0';

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

		$defaults = array(
			'inner_toggle' => 1, // 1 for inner toggle, 0 for checkbox toggle.
		);

		$option = get_option( 'plugin_hide_show_password' );

		$this->options = wp_parse_args( $option, $defaults );

		// Load plugin text domain.
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

		// Load login screen style sheet and JavaScript.
		add_action( 'login_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'login_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		// Register settings
		add_action( 'admin_init', array( $this, 'register_settings' ) );

		// Add an action link pointing to the general options page.
		$plugin_basename = plugin_basename( plugin_dir_path( __FILE__ ) . 'hide-show-password.php' );
		add_filter( 'plugin_action_links_' . $plugin_basename, array( $this, 'add_action_links' ) );
	}

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since 2.0.0
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'hideshowpassword', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}

	/**
	 * Register and enqueue login screen style sheet.
	 *
	 * @since     1.0.0
	 *
	 */
	public function enqueue_styles() {

		$prefix = $this->options['inner_toggle'] ? 'inner-toggle': 'checkbox-toggle';

		wp_enqueue_style(
			'hide-show-password-style',
			plugins_url( "css/public-{$prefix}.css", __FILE__ ),
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

		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		wp_register_script(
			'hide-show-password',
			plugins_url( 'js/vendor/hideShowPassword' . $suffix . '.js', __FILE__ ),
			array( 'jquery' ),
			self::VERSION,
			true
		);

		wp_enqueue_script(
			'hide-show-password-script',
			plugins_url( 'js/public.js', __FILE__ ),
			array( 'jquery', 'hide-show-password' ),
			self::VERSION,
			true
		);

		wp_localize_script(
			'hide-show-password-script',
			'hideShowPasswordVars',
			array(
				'innerToggle' => $this->options['inner_toggle'],
				'checkboxLabel' => __( 'Show Password', 'hideshowpassword' )
			)
		);
	}

	/**
	 * Add a settings section to the 'General Settings' page.
	 *
	 * @since    2.0.0
	 */
	public function register_settings() {
		$option_name = 'plugin_hide_show_password';
		register_setting(
			'general',
			$option_name,
			array( $this, 'settings_validate' )
		);
		add_settings_section(
			$option_name,
			__( 'Hide and show password', 'hideshowpassword' ),
			'__return_false',
			'general'
		);
		add_settings_field(
			'inner_toggle',
			__( 'Toggle password via', 'hideshowpassword' ),
			array( $this, 'settings_radios' ),
			'general',
			$option_name
		);
	}

	/**
	 * Validate settings on save.
	 *
	 * @since    2.0.0
	 */
	public function settings_validate( $input ) {
		$input['inner_toggle'] = ( 0 == $input['inner_toggle'] ) ? 0 : 1;
		return $input;
	}

	/**
	 * Display radio buttons for the 'inner_toggle' option.
	 *
	 * @since 2.0.0
	 *
	 * @return string
	 */
	public function settings_radios() {
		$r = array(
			array( '1', __( 'Icon inside password field', 'hideshowpassword' ) ),
			array( '0', __( 'Checkbox below password field', 'hideshowpassword' ) ),
		);
		foreach ( $r as $v ) {
			$html[] = sprintf( '<input name="plugin_hide_show_password[inner_toggle]" type="radio" value="%s" %s> <span>%s</span>', $v[0], checked( $v[0], $this->options['inner_toggle'], false ), $v[1] );
		}
		printf( '<fieldset id="hide-show-password-settings"><label>%s</label></fieldset>', join( '</label><br><label>', $html ) );
	}

	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since 2.0.0
	 */
	public function add_action_links( $links ) {
		return array_merge(
			array(
				'settings' => '<a href="' . admin_url( 'options-general.php?#hide-show-password-settings' ) . '">' . __( 'Settings', 'hideshowpassword' ) . '</a>'
			),
			$links
		);
	}
}
