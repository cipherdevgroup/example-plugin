// https://github.com/yoavf/grunt-cssjanus
module.exports = {
	plugin: {
		options: {
			swapLtrRtlInUrl: false
		},
		files: [
			{ // Must be done on dev, otherwise /* @noflip */ is removed
				src: '<%= paths.tmp %>example-plugin.css',
				dest: '<%= paths.tmp %>example-plugin.css'
			}
		]
	}
};
