// https://github.com/nDmitry/grunt-autoprefixer
module.exports = {
	options: {
		browsers: [
			'Android >= 2.1',
			'Chrome >= 21',
			'Explorer >= 8',
			'Firefox >= 17',
			'Opera >= 12.1',
			'Safari >= 6.0'
		],
		map: false,
		diff: '<%= paths.logs %>autoprefixer.diff'
	},
	plugin: {
		src: '<%= paths.tmp %>example-plugin.css',
		dest: '<%= paths.tmp %>example-plugin.css'
	}
};
