// https://github.com/jasonlam604/grunt-contrib-rename
module.exports = {
	packagename: {
		files: [
			{
				src: ['<%= paths.plugin %>example-plugin.php'],
				dest: ['<%= paths.plugin %><%= pkg.name %>.php']
			},
			{
				src: ['<%= paths.authorAssets %>js/example-plugin.js'],
				dest: ['<%= paths.authorAssets %>js/<%= pkg.name %>.js']
			},
			{
				src: ['<%= paths.authorAssets %>js/example-plugin-admin.js'],
				dest: ['<%= paths.authorAssets %>js/<%= pkg.name %>-admin.js']
			},
			{
				src: ['<%= paths.authorAssets %>scss/example-plugin.scss'],
				dest: ['<%= paths.authorAssets %>scss/<%= pkg.name %>.scss']
			},
			{
				src: ['<%= paths.authorAssets %>scss/example-plugin-admin.scss'],
				dest: ['<%= paths.authorAssets %>scss/<%= pkg.name %>-admin.scss']
			}
		]
	}
};
