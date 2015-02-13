// https://github.com/gruntjs/grunt-contrib-concat
module.exports = {
	js: {
		src: [
			'<%= paths.bower %>fitvids/js/jquery.fitvids.js',
			'<%= paths.bower %>accessible-menu/js/jquery.accessible-menu.js',
			'<%= paths.bower %>sidr/js/jquery.sidr.min.js',
			'<%= paths.authorAssets %>js/example-plugin.js'
		],
		dest: '<%= paths.plugin %>js/example-plugin.js'
	}
};
