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
	 * Method for setting up the paths used throughout the plugin.
	 *
	 * @since  0.1.0
	 * @access public
	 * @param  array $args arguments to be passed in via the helper function.
	 */
	public function setup_paths( $file ) {
		$this->file = $file;
		$this->dir  = plugin_dir_path( $file );
		$this->uri  = plugin_dir_url( $file );
	}

	/**
	 * Set up the widget.
	 *
	 * @since 0.1.0
	 */
	public function run() {
		if ( $this->file && $this->dir && $this->uri ) {
			$this->build();
		}
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
	 * Store a reference to our classes and get them running.
	 *
	 * @since  0.1.0
	 * @access protected
	 * @param  $factory string the name of our factory class
	 * @return void
	 */
	protected function build() {
		Example_Plugin_Factory::get( 'global-factory' );
	}
}
