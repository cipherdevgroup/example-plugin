// https://github.com/gruntjs/grunt-contrib-watch
module.exports = {
	grunt: {
		options: {
			reload: true
		},
		files: [
			'<%= files.grunt %>',
			'<%= files.config %>'
		],
		tasks: [
			'jshint:grunt',
			'jsvalidate:grunt',
			'jscs:grunt'
		]
	},
	php: {
		options: {
			livereload: true
		},
		files: [
			'<%= files.php %>'
		],
		tasks: [
			'phplint',
			'phpcs'
		]
	},
	js: {
		options: {
			livereload: true
		},
		files: [
			'<%= files.js %>'
		],
		tasks: [
			'build:js',
			'jshint:assets',
			'jsvalidate:assets',
			'jscs:assets'
		]
	},
	scss: {
		options: {
			livereload: true
		},
		files: [
			'<%= files.scss %>'
		],
		tasks: [
			'sass:plugin',
			'autoprefixer',
			'wpcss:css',
			'cssjanus',
			'cssmin:style',
			'replace:style',
			'copy:css'
		]
	}
};
