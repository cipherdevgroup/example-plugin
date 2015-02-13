<?php
/**
 * Example Plugin Default Settings and License Methods.
 *
 * @package     ExamplePlugin
 * @author      Robert Neu
 * @copyright   Copyright (c) 2015, WP Site Care, LLC
 * @license     GPL-2.0+
 * @since       0.0.1
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Example_Plugin_Settings_General extends Example_Plugin_Settings_Base {

	/**
	* Get things running!
	*
	* @since  1.0.0
	* @access public
	* @return void
	*/
	public function run() {
		self::wp_hooks();
		self::add_settings();
	}

	/**
	 * Hook into WordPress. This also calls the base class' wp_hooks method to
	 * make sure the plugin settings are registered correctly.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	protected function wp_hooks() {
		parent::wp_hooks();
	}

	/**
	 * Add our general settings using the provided settings filters. Set the
	 * priority extremely low to prevent additional settings from being
	 * registered before our general plugin settings.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function add_settings() {
		add_filter( $this->key,          array( $this, 'add_settings_general' ), 0 );
		add_filter( "{$this->key}_tabs", array( $this, 'add_general_tab'      ), 0 );
	}

	/**
	 * Retrieve the array of plugin settings
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	*/
	public function add_settings_general( $settings ) {
		$general = array(
			// General Settings
			'general' => array(
				'license' => array(
					'name' => '<strong>' . esc_attr__( 'General Settings', 'example-plugin' ) . '</strong>',
					'desc' => '',
					'type' => 'header',
				),
				'example_text' => array(
					'name' => esc_attr__( 'License Key', 'example-plugin' ),
					'desc' => '<p class="description">' . __( 'Example text.', 'example-plugin' ) . '</p>',
					'type' => 'text',
				),
			),
		);

		$general = apply_filters( 'example_plugin_settings_general', $general );

		return array_merge( $settings, $general );
	}

	/**
	* Add the general settings tab into the array of available settings tabs.
	*
	* @since  1.0.0
	* @access public
	* @param  $tabs array of tab areas
	* @return $tabs array of updated tab areas
	*/
	public function add_general_tab( $tabs ) {
		$tabs['general'] = __( 'General', 'example-plugin' );
		return $tabs;
	}

}
