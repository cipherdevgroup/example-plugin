// https://github.com/sindresorhus/grunt-sass
module.exports = {
	options: {
		sourceMap: true,
		lineNumbers: false,
		outputStyle: 'expanded'
	},
	plugin: {
		files: [
			{
				src: '<%= paths.cssSrc %>plugin.scss',
				dest: '<%= paths.cssDist %><%= pkg.nameDashed %>.css'
			}
		]
	}
};
