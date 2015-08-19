// https://github.com/sindresorhus/grunt-sass
module.exports = {
	options: {
		sourceMap: false,
		lineNumbers: false,
		outputStyle: 'expanded'
	},
	plugin: {
		files: {
			'<%= paths.tmp %>example-plugin.css': '<%= paths.cssSrc %>example-plugin.scss'
		}
	}
};
