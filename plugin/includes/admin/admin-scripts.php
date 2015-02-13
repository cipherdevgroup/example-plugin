<?php
/**
 * Example Plugin admin scripts class.
 *
 * @package     ExamplePlugin
 * @author      Robert Neu
 * @copyright   Copyright (c) 2015, WP Site Care, LLC
 * @license     GPL-2.0+
 * @since       0.0.1
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Our Example_Plugin_Admin_Scripts class to register admin styles and scripts.
 *
 * @package Example_Plugin
 * @version 0.0.1
 */
class Example_Plugin_Admin_Scripts {

	/**
	* A script prefix to load minified scripts and styles unless debugging.
	*
	* @since  0.0.1
	* @var   string
	*/
	private $prefix;

	/**
	* Get things running!
	*
	* @since  0.0.1
	* @access public
	* @return void
	*/
	public function run() {
		$this->prefix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		self::wp_hooks();
	}

	/**
	* Hook into WordPress.
	*
	* @since  0.0.1
	* @access public
	* @return void
	*/
	public function wp_hooks() {
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
	}

	/**
	 * Load admin styles for Example Plugin.
	 *
	 * @since   0.0.1
	 * @access  public
	 * @return  void
	 */
	function admin_styles() {
		if ( ! example_plugin()->settings_page->is_admin_page() ) {
			return;
		}
		wp_enqueue_style(
			'example-plugin',
			EXAMPLE_PLUGIN_URL . "css/example-plugin-admin{$this->prefix}.css",
			null,
			'0.0.1'
		);
	}

	/**
	 * Load admin scripts for Example Plugin.
	 *
	 * @since   0.0.1
	 * @access  public
	 * @return  void
	 */
	function admin_scripts() {
		if ( ! example_plugin()->settings_page->is_admin_page() ) {
			return;
		}
		wp_enqueue_script(
			'example-plugin',
			EXAMPLE_PLUGIN_URL . "js/example-plugin-admin{$this->prefix}.js",
			array( 'jquery' ),
			'0.0.1',
			true
		);
	}
}
