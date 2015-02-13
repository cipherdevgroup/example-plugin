// https://github.com/gruntjs/grunt-contrib-concat
module.exports = {
	js: {
		src: [
			'<%= paths.authorAssets %>js/example-plugin.js'
		],
		dest: '<%= paths.plugin %>js/example-plugin.js'
	},
	adminjs: {
		src: [
			'<%= paths.authorAssets %>js/example-plugin-admin.js'
		],
		dest: '<%= paths.plugin %>js/example-plugin-admin.js'
	}
};
