// https://github.com/mattstyles/grunt-banner
module.exports = {
	plugin: {
		options: {
			position: 'top',
			banner: '/*!\n' +
				'Theme Name:  <%= pkg.plugin.name %>\n' +
				'Version:     <%= pkg.version %>\n' +
				'Author:      <%= pkg.plugin.author %>\n' +
				'Author URI:  <%= pkg.plugin.authoruri %>\n' +
				'Theme URI:   <%= pkg.plugin.uri %>\n' +
				'Description: <%= pkg.plugin.description %>\n' +
				'Tags:        <%= pkg.plugin.tags %>\n' +
				'Text Domain: <%= pkg.plugin.textdomain %>\n' +
				'Domain Path: <%= pkg.plugin.domainpath %>\n' +
				'License:     <%= pkg.plugin.license %>\n' +
				'License URI: <%= pkg.plugin.licenseuri %>\n' +
				'*/\n',
			linebreak: true
		},
		files: [
			{
				cwd: '<%= paths.tmp %>',
				src: 'example-plugin.css',
				dest: '<%= paths.tmp %>',
				expand: true
			}
		]
	}
};
