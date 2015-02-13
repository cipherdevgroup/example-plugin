// https://github.com/gruntjs/grunt-contrib-copy
module.exports = {
	css: {
		files: [
			{
				cwd: '<%= paths.tmp %>',
				expand: true,
				flatten: true,
				src: ['*.css', '*.map'],
				dest: '<%= paths.plugin %>css/',
				filter: 'isFile'
			}
		]
	},
	font: {
		files: [
			{
				cwd: '<%= paths.authorAssets %>font',
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
				src: [],
				dest: '<%= paths.plugin %>images',
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
	}
};
