// https://github.com/jgable/grunt-phplint
module.exports = {
	plugin: [
		'<%= files.php %>',
		'!<%= paths.plugin %>includes/vendor/**/*.php'
	]
};
