// https://github.com/blazersix/grunt-wp-i18n
module.exports = {
	options: {
		textdomain: '<%= pkg.plugin.textdomain %>',
		updateDomains: ['all']
	},
	php: {
		files: {
			src: [
				'<%= files.php %>'
			]
		}
	}
};
