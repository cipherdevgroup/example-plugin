// https://github.com/gruntjs/grunt-contrib-copy
module.exports = {
	css: {
		files: [
			{
				expand: true,
				flatten: true,
				cwd: '<%= paths.tmp %>',
				src: [
					'*.css',
					'**/*.css'
				],
				dest: 'css/',
				filter: 'isFile'
			}
		]
	},
	fonts: {
		files: [
			{
				expand: true,
				flatten: true,
				src: [
					'<%= paths.fontSrc %>fonts/**/*'
				],
				dest: 'fonts/'
			}
		]
	},
	images: {
		files: [
			{
				expand: true,
				flatten: true,
				cwd: '<%= paths.tmp %>images',
				src: [ '*' ],
				dest: 'images',
				filter: 'isFile'
			}
		]
	},
	languages: {
		files: [
			{
				expand: true,
				cwd: '<%= paths.assets %><%= paths.languages %>',
				src: [ '*.po' ],
				dest: '<%= paths.plugin %><%= paths.languages %>',
				filter: 'isFile'
			}
		]
	},
	bowercss: {
		files: [
			{
				expand: true,
				cwd: 'bower_components/',
				src: [],
				dest: '<%= paths.cssSrc %>'
			}
		]
	},
	bowerjs: {
		files: [
			{
				expand: true,
				flatten: true,
				cwd: 'bower_components/',
				src: [],
				dest: '<%= paths.jsSrc %>'
			}
		]
	},
	bowerfonts: {
		files: [
			{
				expand: true,
				flatten: true,
				cwd: 'bower_components/',
				src: [],
				dest: '<%= paths.fontSrc %>icons/',
				rename: function( dest, src ) {
					'use strict';
					return dest + '/' + src.replace( 'themicons_', '' );
				}
			}
		]
	}
};
