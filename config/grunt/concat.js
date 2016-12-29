// https://github.com/gruntjs/grunt-contrib-concat
module.exports = {
	js: {
		src: [
			'<%= paths.jsSrc %>**/*.js',
			'!<%= paths.jsSrc %>**/*.min.js',
			'!<%= paths.jsSrc %>admin/**/*'
		],
		dest: '<%= paths.jsDist %><%= pkg.nameCamelLow %>.pkgd.js'
	},
	adminjs: {
		src: [
			'<%= paths.jsSrc %>admin/**/*.js',
			'!<%= paths.jsSrc %>admin/**/*.min.js'
		],
		dest: '<%= paths.jsDist %><%= pkg.nameCamelLow %>Admin.pkgd.js'
	}
};
