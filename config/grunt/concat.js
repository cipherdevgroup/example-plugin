// https://github.com/gruntjs/grunt-contrib-concat
module.exports = {
	js: {
		src: [
			'<%= paths.jsSrc %>**/*.js'
		],
		dest: 'js/<%= pkg.nameCamelLow %>.pkgd.js'
	}
};
