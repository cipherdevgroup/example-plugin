<?php
/**
 * Example Plugin main plugin class.
 *
 * @package   WPSiteCare/ExamplePlugin
 * @copyright Copyright (c) 2015, WP Site Care
 * @license   MIT
 * @since     0.1.0
 */

// Prevent direct access.
defined( 'ABSPATH' ) || exit;

/**
 * Main plugin class.
 */
class Example_Plugin {

	/**
	 * The current plugin version.
	 *
	 * @since 0.1.0
	 * @var   string
	 */
	private $version = '0.1.0';

	/**
	 * The main plugin file.
	 *
	 * @since 0.1.0
	 * @var   string
	 */
	private $file = __FILE__;

	/**
	 * The plugin's directory path with a trailing slash.
	 *
	 * @since 0.1.0
	 * @var   string
	 */
	private $dir;

	/**
	 * The plugin directory URL with a trailing slash.
	 *
	 * @since 0.1.0
	 * @var   string
	 */
	private $url;

	/**
	 * The plugin scripts class object.
	 *
	 * @since 0.1.0
	 * @var   object Example_Plugin_Scripts
	 */
	public $scripts;

	/**
	 * An empty placeholder for referencing the main plugin admin class.
	 *
	 * @since 0.1.0
	 * @var   object Example_Plugin_Admin
	 */
	public $admin;

	public function __construct() {
		$this->dir = plugin_dir_path( __FILE__ );
		$this->url = plugin_dir_url( __FILE__ );
	}

	/**
	 * Method to initialize the plugin.
	 *
	 * @since  0.1.0
	 * @return void
	 */
	public function run() {
		self::includes();
		self::instantiate();
		if ( is_admin() ) {
			self::load_textdomain();
		}
	}

	/**
	 * Retrieve the plugin version number.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return string
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Retrieve a trailing slashed path to the plugin directory.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return string
	 */
	public function get_file() {
		return $this->file;
	}

	/**
	 * Retrieve a trailing slashed path to the plugin directory.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return string
	 */
	public function get_dir() {
		return $this->dir;
	}

	/**
	 * Retrieve a trailing slashed URL to the plugin directory.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return string
	 */
	public function get_url() {
		return $this->url;
	}

	/**
	 * Loads the plugin language files
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function load_textdomain() {
		load_plugin_textdomain(
			'example-plugin',
			false,
			dirname( plugin_basename( __FILE__ ) ) . '/languages'
		);
	}

	/**
	 * Require all plugin files.
	 *
	 * @since  0.1.0
	 * @access private
	 * @return void
	 */
	private function includes() {
		require_once $this->dir . 'includes/class-scripts.php';
		if ( is_admin() ) {
			require_once $this->dir . 'admin/class-init.php';
		} else {
			require_once $this->dir . 'includes/class-public-scripts.php';
		}
	}

	/**
	 * Load all required files and get all of our classes running.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	private function instantiate() {
		if ( is_admin() ) {
			$this->admin = new Example_Plugin_Admin;
			$this->admin->run();
		} else {
			$this->scripts = new Example_Plugin_Public_Scripts;
			$this->scripts->run();
		}
	}

	/**
	 * Runs on plugin activation to set a default admin content label for all
	 * existing posts using the post title.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function activate() {
		// Nothing yet.
	}

}
