// https://github.com/kswedberg/grunt-version
module.exports = {
	options: {
		pkg: {
			version: '<%= package.version %>'
		}
	},
	project: {
		src: [
			'package.json',
			'bower.json'
		]
	},
	phpConstant: {
		options: {
			prefix: 'EXAMPLE_PLUGIN_VERSION\'\,\\s+\''
		},
		src: [
			'example-plugin.php'
		]
	},
	style: {
		options: {
			prefix: '\\s+\\*\\s+Version:\\s+'
		},
		src: [
			'example-plugin.php',
			'<%= paths.cssSrc %>example-plugin.scss'
		]
	}
};
