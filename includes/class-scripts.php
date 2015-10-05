<?php
/**
 * A base for loading plugin scripts. Useful for both public and admin scripts.
 *
 * @package   ExamplePlugin
 * @copyright Copyright (c) 2015, WP Site Care
 * @license   MIT
 * @since     0.1.0
 */

// Prevent direct access.
defined( 'ABSPATH' ) || exit;

abstract class Example_Plugin_Scripts {
	/**
	 * A script suffix to load minified assets on production sites.
	 *
	 * @since 0.1.0
	 * @var   string
	 */
	protected $suffix;

	/**
	 * The current plugin version.
	 *
	 * @since 0.1.0
	 * @var   string
	 */
	protected $version;

	/**
	 * Constructor method.
	 *
	 * @since 0.1.0
	 */
	public function __construct() {
		$this->suffix  = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		$this->version = example_plugin()->get_version();
	}

	/**
	 * Helper function to determine whether or not to load a packed version of
	 * our JavaScript libraries on the front end.
	 *
	 * Developers can filter example_plugin_enable_packed_js to false if they
	 * are loading any of the following libraries in their theme or plugin:
	 *
	 * @since  0.1.0
	 * @access protected
	 * @return bool
	 */
	protected function enable_packed_js() {
		if ( empty( $this->suffix ) ) {
			return false;
		}
		return apply_filters( 'example_plugin_enable_packed_js', true );
	}

	/**
	 * Helper function for getting the script `.min` suffix for minified files.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return string
	 */
	public function get_suffix() {
		return $this->suffix;
	}

	/**
	 * Return the path to the plugin JavaScript directory with a trailing slash.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return string
	 */
	public function get_js_uri( $path ) {
		return example_plugin()->get_uri( 'js/' ) . ltrim( $path );
	}

	/**
	 * Return the path to the plugin css directory with a trailing slash.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return string
	 */
	public function get_css_uri( $path ) {
		return example_plugin()->get_uri( 'css/' ) . ltrim( $path );
	}
}
