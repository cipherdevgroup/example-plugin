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
	 * A script prefix to load minified assets on production sites.
	 *
	 * @since 0.1.0
	 * @var   string
	 */
	protected $suffix;

	/**
	 * The plugin's root URL with a trailing slash.
	 *
	 * @since 0.1.0
	 * @var   string
	 */
	protected $url;

	/**
	 * The current plugin version.
	 *
	 * @since 0.1.0
	 * @var   string
	 */
	protected $version;

	public function __construct() {
		$this->suffix  = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		$this->url     = example_plugin()->get_url();
		$this->version = example_plugin()->get_version();
	}

	/**
	 * Get the class running!
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function run() {
		if ( ! method_exists( $this, 'wp_hooks' ) ) {
			_doing_it_wrong(
				'Example_Plugin_Scripts',
				esc_attr__( 'When extending Example_Plugin_Scripts, you must create a wp_hooks method.', 'example-plugin' )
			);
			return;
		}
		$this->wp_hooks();
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

}
