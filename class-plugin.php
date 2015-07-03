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
		self::load_textdomain();
		spl_autoload_register( array( $this, 'autoloader' ) );
		self::instantiate( 'Example_Plugin_Factory' );
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
	 * Load all plugin classes when they're instantiated.
	 *
	 * @since  0.1.0
	 * @access private
	 * @return void
	 */
	protected function autoloader( $class ) {
		$class = strtolower( str_replace( '_', '-', str_replace( __CLASS__ . '_', '', $class ) ) );
		$file  = "{$this->dir}includes/class-{$class}.php";

		if ( false !== strpos( $class, 'admin' ) ) {
			$class = str_replace( 'admin-', '', $class );
			$file  = "{$this->dir}admin/class-{$class}.php";
		}

		if ( file_exists( $file ) ) {
			require_once $file;
			return true;
		}
		return false;
	}

	/**
	 * Load all required files and get all of our classes running.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	private function instantiate() {
		if ( ! is_admin() ) {
			$factory::build( 'public-scripts' );
			$factory::get( 'public-scripts' )->run();
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
