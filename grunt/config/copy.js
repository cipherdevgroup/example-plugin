// https://github.com/gruntjs/grunt-contrib-copy
module.exports = {
	css: {
		files: [
			{
				cwd: '<%= paths.tmp %>',
				expand: true,
				flatten: true,
				src: ['style*.css', 'style*.map'],
				dest: '<%= paths.plugin %>',
				filter: 'isFile'
			}
		]
	},
	vendorcss: {
		files: [
			{
				expand: true,
				flatten: true,
				src: [],
				dest: '<%= paths.plugin %>css/',
				filter: 'isFile'
			}
		]
	},
	font: {
		files: [
			{
				expand: true,
				flatten: true,
				src: [],
				dest: '<%= paths.plugin %>font/'
			}
		]
	},
	images: {
		files: [
			{
				cwd: '<%= paths.tmp %>images',
				expand: true,
				flatten: true,
				src: ['*', '!screenshot.png'],
				dest: '<%= paths.plugin %>images',
				filter: 'isFile'
			}
		]
	},
	screenshot: {
		files: [
			{
				cwd: '<%= paths.tmp %>images',
				expand: true,
				flatten: true,
				src: ['screenshot.png'],
				dest: '<%= paths.plugin %>',
				filter: 'isFile'
			}
		]
	},
	languages: {
		files: [
			{
				cwd: '<%= paths.assets %><%= paths.languages %>',
				expand: true,
				src: ['*.po'],
				dest: '<%= paths.plugin%><%= paths.languages %>',
				filter: 'isFile'
			}
		]
	},
	packagename: {
		files: [
			{
				expand: true,
				dot: true,
				src: [
					'**',
					'.*',
					'!<%= paths.bower %>**/*',
					'!<%= paths.composer %>**/*',
					'!node_modules/**',
					'!.sass-cache/**',
					'!dist/**',
					'!logs/**',
					'!tmp/**',
					'!*.sublime*',
					'!.DS_Store'
				],
				dest: '/',
				filter: 'isFile',
				rename: function( dest, src ) {
					'use strict';
					return dest + src.replace( 'example-plugin','<%= pkg.name %>' );
				}
			}
		]
	}
};
