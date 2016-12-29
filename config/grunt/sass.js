// https://github.com/sindresorhus/grunt-sass
module.exports = {
	options: {
		sourceMap: true,
		lineNumbers: false,
		outputStyle: 'expanded'
	},
	plugin: {
		files: {
			'<%= paths.cssDist %>example-plugin.css': '<%= paths.cssSrc %>plugin.scss'
		}
	}
};
