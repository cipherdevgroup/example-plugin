<?php
/**
 * All default actions for the plugin.
 *
 * @package    ExamplePlugin\Admin\Actions
 * @copyright  Copyright (c) 2016, WP Site Care
 * @license    MIT
 * @since      0.1.0
 */

defined( 'WPINC' ) || die;

/**
 * Callback defined in includes/language.php
 *
 * @see example_plugin_load_textdomain
 */
add_action( 'admin_head-plugins.php', 'example_plugin_load_textdomain' );
