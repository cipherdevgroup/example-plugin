// https://github.com/gruntjs/grunt-contrib-sass
module.exports = {
	options: {
		force: true,
		sourcemap: 'none',
		style: 'expanded',
		trace: true,
		lineNumbers: false
	},
	plugin: {
		files: [
			{
				expand: true,
				cwd: '<%= paths.authorAssets %>scss/',
				src: 'example-plugin.scss',
				dest: '<%= paths.tmp %>',
				ext: '.css'
			}
		]
	}
};
