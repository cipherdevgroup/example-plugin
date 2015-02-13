// https://github.com/alappe/grunt-phpmd
module.exports = {
	options: {
		reportFormat: 'text',
		reportFile: '<%= paths.logs %>phpmd.log',
		strict: true,
		rulesets: 'phpmd.xml'
	},
	plugin: {
		dir: '<%= paths.plugin %>'
	}
};
