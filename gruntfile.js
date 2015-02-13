/* global require, process */
module.exports = function( grunt ) {
	'use strict';

	// Load grunt plugins
	require( 'time-grunt' )(grunt);

	// Define project configuration
	var project = {
		paths: {
			get authorAssets() {
				return this.assets + 'author/';
			},
			get bower() {
				return this.assets + 'bower/';
			},
			get composer() {
				return this.assets + 'composer/';
			},
			get config() {
				return this.grunt + 'config/';
			},
			get tasks() {
				return this.grunt + 'tasks/';
			},
			assets: 'assets/',
			dist: 'dist/',
			docs: 'docs/',
			grunt: 'grunt/',
			languages: 'languages/',
			logs: 'logs/',
			plugin: 'plugin/',
			tmp: 'tmp/'
		},
		files: {
			get php() {
				return project.paths.plugin + '**/*.php';
			},
			get js() {
				return project.paths.assets + '{,*/}js/*.js';
			},
			get scss() {
				return project.paths.authorAssets + 'scss/**/*.scss';
			},
			get config() {
				return project.paths.config + '*.js';
			},
			get changelog() {
				return project.paths.plugin + 'CHANGELOG.md';
			},
			grunt: 'Gruntfile.js'
		},
		pkg: grunt.file.readJSON( 'package.json' )
	};

	// Load Grunt plugin configurations
	require( 'load-grunt-config' )(grunt, {
		configPath: require( 'path' ).join( process.cwd(), project.paths.config ),
		data: project,
		jitGrunt: {
			staticMappings: {
				addtextdomain: 'grunt-wp-i18n',
				makepot: 'grunt-wp-i18n',
				scsslint: 'grunt-scss-lint',
				usebanner: 'grunt-banner',
				wpcss: 'grunt-wp-css'
			},
			loadTasks: project.paths.tasks
		}
	});
};
