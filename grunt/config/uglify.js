// https://github.com/gruntjs/grunt-contrib-uglify
module.exports = {
	plugin: {
		options: {
			sourceMap: true,
			sourceMapName: '<%= paths.plugin %>js/example-plugin.js.map',
			sourceMapIncludeSources: true,
			mangle: true,
			compress: true,
			report: 'gzip'
		},
		files: [
			{
				expand: true,
				cwd: '<%= paths.plugin %>js/',
				src: '*.js',
				dest: '<%= paths.plugin %>js/',
				ext: '.min.js',
				extDot: 'last'
			}
		]
	}
};
