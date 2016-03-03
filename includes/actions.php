<?php
/**
 * Load all public-facing scripts for the plugin.
 *
 * @package    ExamplePlugin
 * @subpackage ExamplePlugin\Classes
 * @author     Robert Neu
 * @copyright  Copyright (c) 2016, WP Site Care
 * @license    MIT
 * @since      0.1.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Callback defined in includes/language.php
 *
 * @see example_plugin_load_textdomain
 */
add_action( 'admin_head-plugins.php', 'example_plugin_load_textdomain' );

/**
 * Callback defined in includes/scripts.php
 *
 * @see example_plugin_load_css
 */
add_action( 'wp_enqueue_scripts', 'example_plugin_load_css', 20 );

/**
 * Callback defined in includes/scripts.php
 *
 * @see example_plugin_load_js
 */
add_action( 'wp_enqueue_scripts', 'example_plugin_load_js',  20 );

/**
 * Callback defined in includes/scripts.php
 *
 * @see example_plugin_maybe_disable
 */
add_action( 'wp_enqueue_scripts', 'example_plugin_maybe_disable' );
