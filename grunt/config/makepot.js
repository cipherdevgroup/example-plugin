// https://github.com/blazersix/grunt-wp-i18n
module.exports = {
	plugin: {
		options: {
			cwd: '<%= paths.plugin %>',
			domainPath: '<%= paths.languages %>',
			potHeaders: {
				poedit: true,
				'report-msgid-bugs-to': '<%= pkg.pot.reportmsgidbugsto %>',
				'last-translator': '<%= pkg.pot.lasttranslator %>',
				'language-team': '<%= pkg.pot.languageteam %>'
			},
			type: 'wp-plugin'
		}
	}
};
