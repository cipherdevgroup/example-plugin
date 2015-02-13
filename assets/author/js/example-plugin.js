/**
 * Global JavaScript for Example Plugin
 *
 * Includes all JS which is required within all sections of the plugin.
 */

window.examplePlugin = window.examplePlugin || {};

(function( window, $, undefined ) {
	'use strict';

	var examplePlugin = window.examplePlugin;

	$.extend( examplePlugin, {

		// Global scripts init.
		globalInit: function() {
			// Code.
		}

	});

	// Document ready.
	jQuery(function() {
		examplePlugin.globalInit();
	});
})( this, jQuery );
