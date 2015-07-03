module.exports = function() {
	'use strict';
	var tasks = {
		'build:dependencies:fonts': [
			'clean:fonts',
			'bower_install',
			'copy:bowerfonts'
		],
		'build:dependencies:css': [
			'clean:css',
			'bower_install',
			'copy:bowercss'
		],
		'build:dependencies:js': [
			'clean:js',
			'bower_install',
			'copy:bowerjs'
		],
		'build:fonts': [
			'build:dependencies:fonts',
			'newer:copy:fonts',
			'newer:imagemin:icons',
			'webfont'
		],
		'build:css': [
			'build:dependencies:css',
			'newer:sass',
			'newer:usebanner',
			'newer:autoprefixer',
			'newer:wpcss',
			'newer:cssjanus',
			'newer:cssmin',
			'newer:replace:style',
			'newer:copy:css'
		],
		'build:images': [
			'newer:imagemin:images',
			'newer:copy:images'
		],
		'build:js': [
			'build:dependencies:js',
			'newer:concat:js',
			'newer:uglify'
		]
	};

	return tasks;
};
