// https://github.com/alappe/grunt-phpcpd
module.exports = {
	options: {
		ignoreExitCode: true,
		reportFile: '<%= paths.logs %>phpcpd.log',
		quiet: false,
		minTokens: 20
	},
	plugin: {
		dir: '<%= paths.plugin %>'
	}
};
