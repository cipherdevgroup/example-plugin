<?php
/**
 * Example Plugin main plugin class.
 *
 * @package   ExamplePlugin
 * @copyright Copyright (c) 2015, WP Site Care
 * @license   MIT
 * @since     0.1.0
 */

// Prevent direct access.
defined( 'ABSPATH' ) || exit;

/**
 * Main plugin class.
 */
class Example_Plugin_Plugin {
	/**
	 * Our plugin version number.
	 *
	 * @since 0.1.0
	 * @type  string
	 */
	const VERSION = '0.1.0';

	/**
	 * The main plugin file.
	 *
	 * @since 0.1.0
	 * @var   string
	 */
	private $file = false;

	/**
	 * The plugin's directory path with a trailing slash.
	 *
	 * @since 0.1.0
	 * @var   string
	 */
	private $dir = false;

	/**
	 * The plugin directory URL with a trailing slash.
	 *
	 * @since 0.1.0
	 * @var   string
	 */
	private $url = false;

	/**
	 * Constructor method.
	 *
	 * @since  0.1.0
	 * @access public
	 * @param  string $file the path to the root plugin file
	 * @return void
	 */
	public function __construct( $file ) {
		$this->setup_paths( $file );
	}

	/**
	 * Method for setting up the paths used throughout the plugin.
	 *
	 * @since  0.1.0
	 * @access public
	 * @param  string $file the path to the root plugin file
	 * @return void
	 */
	public function setup_paths( $file ) {
		$this->file = $file;
		$this->dir  = plugin_dir_path( $file );
		$this->uri  = plugin_dir_url( $file );
	}

	/**
	 * Build and store references to all the plugin's global objects.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function run() {
		Example_Plugin_Factory::get( 'global-factory' );
	}

	/**
	 * Getter method for reading the protected version variable.
	 *
	 * @since  0.2.0
	 * @access public
	 * @return bool
	 */
	public function get_version() {
		return self::VERSION;
	}

	/**
	 * Return the path to the plugin directory with a trailing slash.
	 *
	 * @since  0.2.0
	 * @access public
	 * @return string
	 */
	public function get_dir( $path = '' ) {
		return $this->dir . ltrim( $path );
	}

	/**
	 * Return the URI to the plugin directory with a trailing slash.
	 *
	 * @since  0.2.0
	 * @access public
	 * @return string
	 */
	public function get_uri( $path = '' ) {
		return $this->uri . ltrim( $path );
	}

	/**
	 * Get a single instance of the main plugin class.
	 *
	 * @since  0.1.0
	 * @access public
	 * @param  string $file the path to the root plugin file
	 * @return object Example_Plugin_Plugin
	 */
	public static function get_instance( $file ) {
		static $instance;
		if ( is_null( $instance ) ) {
			$instance = new self( $file );
		}
		return $instance;
	}
}
