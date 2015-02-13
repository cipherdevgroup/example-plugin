// https://github.com/outaTiME/grunt-replace
module.exports = {
	style: {
		options: {
			patterns: [
				{
					// Add line break between banner and minified
					match: /\*\/(?=\S)/g,
					replacement: '*/\n'
				}
			]
		},
		files: [{
			expand: true,
			src: [
				'<%= paths.tmp %>example-plugin.min.css',
				'<%= paths.tmp %>example-plugin-rtl.min.css'
			]
		}]
	},
	release: {
		options: {
			patterns: [
				{
					match: 'release',
					replacement: '<%= pkg.version %>'
				}
			]
		},
		files: [
			{
				expand: true,
				src: [
					'<%= paths.plugin %>**/*'
				]
			}
		]
	},
	// Useful when forking this project into a new project
	packagename: {
		options: {
			patterns: [
				{
					match: /example plugin/g,
					replacement: '<%= pkg.lowername %>'
				},
				{
					match: /ExamplePlugin/g,
					replacement: '<%= pkg.capitalname %>'
				},
				{
					match: /ExamplePlugin/g,
					replacement: '<%= pkg.packname %>'
				},
				{
					match: /EXAMPLE_PLUGIN/g,
					replacement: '<%= pkg.constname %>'
				},
				{
					match: /Example_Plugin/g,
					replacement: '<%= pkg.classname %>'
				},
				{
					match: /example_plugin/g,
					replacement: '<%= pkg.funcname %>'
				},
				{
					match: /example-plugin/g,
					replacement: '<%= pkg.name %>'
				},
				{
					match: /examplePlugin/g,
					replacement: '<%= pkg.camelname %>'
				}
			]
		},
		files: [
			{
				expand: true,
				src: [
					'**',
					'.*',
					'!<%= paths.bower %>**/*',
					'!<%= paths.composer %>**/*',
					'!**/*.{png,ico,jpg,gif}',
					'!node_modules/**',
					'!.sass-cache/**',
					'!dist/**',
					'!logs/**',
					'!tmp/**',
					'!*.sublime*',
					'!.DS_Store'
				]
			}
		]
	}
};
