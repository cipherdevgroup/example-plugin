// https://github.com/SaschaGalley/grunt-phpcs
module.exports = {
	options: {
		standard: 'WordPress',
		ignoreExitCode: true,
		ignore: [
			'<%= paths.plugin %>includes/vendor/'
		]
	},
	php: {
		options: {
			extensions: 'php',
			reportFile: '<%= paths.logs %>phpcs.log'
		},
		dir: [
			'<%= paths.plugin %>'
		]
	}
};
