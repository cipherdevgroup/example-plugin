// https://github.com/jasonlam604/grunt-contrib-rename
module.exports = {
	packagename: {
		files: [
			{
				src: ['<%= paths.plugin %>example-plugin.php'],
				dest: ['<%= paths.plugin %><%= pkg.name %>.php']
			},
			{
				src: ['<%= paths.authorAssets %>js/example-plugin*'],
				dest: ['<%= paths.authorAssets %>js/<%= pkg.name %>.js']
			},
			{
				src: ['<%= paths.authorAssets %>scss/example-plugin*'],
				dest: ['<%= paths.authorAssets %>scss/<%= pkg.name %>.scss']
			}
		]
	}
};
