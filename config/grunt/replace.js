// https://github.com/outaTiME/grunt-replace
module.exports = {
	// Useful when forking this project into a new project
	packagename: {
		options: {
			patterns: [
				{
					match: /Example Plugin/g,
					replacement: '<%= pkg.nameSpaced %>'
				},
				{
					match: /example plugin/g,
					replacement: '<%= pkg.nameSpacedLow %>'
				},
				{
					match: /example-plugin/g,
					replacement: '<%= pkg.nameDashed %>'
				},
				{
					match: /example_plugin/g,
					replacement: '<%= pkg.nameUscore %>'
				},
				{
					match: /EXAMPLE_PLUGIN/g,
					replacement: '<%= pkg.nameUscoreUp %>'
				},
				{
					match: /Example_Plugin/g,
					replacement: '<%= pkg.nameUscoreCam %>'
				},
				{
					match: /ExamplePlugin/g,
					replacement: '<%= pkg.nameCamel %>'
				},
				{
					match: /examplePlugin/g,
					replacement: '<%= pkg.nameCamelLow %>'
				}
			]
		},
		files: [
			{
				expand: true,
				src: [
					'**',
					'.*',
					'!**/*.{png,ico,jpg,gif}',
					'!node_modules/**',
					'!bower_components/**',
					'!.sass-cache/**',
					'!release/**',
					'!logs/**',
					'!tmp/**',
					'!*.sublime*',
					'!.idea/**',
					'!.DS_Store'
				]
			}
		]
	}
};
