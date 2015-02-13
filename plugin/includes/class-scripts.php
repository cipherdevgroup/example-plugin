<?php
/**
 * Walkie Talkie Dashboard class.
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
 * Our Example_Plugin_Scripts class which registers all admin styles and scripts.
 *
 * @package Example_Plugin
 * @version 0.0.1
 */
class Example_Plugin_Admin_Scripts {

	private $css_uri;

	private $js_uri;

	private $prefix;

	/**
	* Get things running!
	*
	* @since  0.0.1
	* @access public
	* @return void
	*/
	public function run() {
		$this->css_uri = EXAMPLE_PLUGIN_URL . 'assets/css/';
		$this->js_uri  = EXAMPLE_PLUGIN_URL . 'assets/js/';
		$this->prefix  = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
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
	 * Load admin styles for Walkie Talkie.
	 *
	 * @since   0.0.1
	 * @access  public
	 * @return  void
	 */
	function admin_styles() {
		if ( ! example_plugin()->is_admin_page() ) {
			return;
		}
		wp_enqueue_style(
			'example-plugin',
			$this->css_uri . "example-plugin{$this->prefix}.css",
			null,
			'0.0.1'
		);
	}

	/**
	 * Load admin scripts for Walkie Talkie.
	 *
	 * @since   0.0.1
	 * @access  public
	 * @return  void
	 */
	function admin_scripts() {
		if ( ! example_plugin()->is_admin_page() ) {
			return;
		}
		wp_enqueue_script(
			'example-plugin',
			$this->js_uri . "example-plugin{$this->prefix}.js",
			array( 'jquery' ),
			'0.0.1',
			true
		);
	}
}
