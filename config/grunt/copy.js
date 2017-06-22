// https://github.com/gruntjs/grunt-contrib-copy
module.exports = {
	css: {
		files: []
	},
	js: {
		files: [
			{
				expand: true,
				flatten: true,
				cwd: '<%= paths.jsSrc %>',
				src: [
					'plugin.js'
				],
				dest: '<%= paths.jsDist %>',
				rename: function( dest, src ) {
					return dest + src.replace( 'plugin', '<%= pkg.nameCamelLow %>' );
				}
			}
		]
	},
	fonts: {
		files: [
			{
				expand: true,
				flatten: true,
				cwd: '<%= paths.fontsSrc %>',
				src: [
					'**/*'
				],
				dest: '<%= paths.fontsDist %>',
				filter: 'isFile'
			}
		]
	},
	languages: {
		files: [
			{
				expand: true,
				cwd: '<%= paths.assets %><%= paths.languages %>',
				src: [ '*.po' ],
				dest: '<%= paths.plugin %><%= paths.languages %>',
				filter: 'isFile'
			}
		]
	},
	rename: {
		files: [
			{
				expand: true,
				dot: true,
				cwd: '',
				dest: '',
				src: [
					'example-plugin.php'
				],
				rename: function( dest, src ) {
					return dest + src.replace( 'example-plugin', '<%= pkg.nameDashed %>' );
				}
			},
			{
				expand: true,
				dot: true,
				cwd: '<%= paths.jsSrc %>',
				dest: '<%= paths.jsSrc %>',
				src: [
					'**/*.js'
				],
				rename: function( dest, src ) {
					return dest + src.replace( 'examplePlugin', '<%= pkg.nameCamelLow %>' );
				}
			},
			{
				expand: true,
				dot: true,
				cwd: '<%= paths.cssSrc %>',
				dest: '<%= paths.cssSrc %>',
				src: [
					'**/*.scss'
				],
				rename: function( dest, src ) {
					return dest + src.replace( 'example-plugin', '<%= pkg.nameDashed %>' );
				}
			}
		]
	},
	release: {
		files: [
			{
				expand: true,
				src: [
					'**',
					'.*',
					'!.git/**',
					'!.sass-cache/**',
					'!.jscsrc',
					'!.jshintrc',
					'!config/**',
					'!assets/**',
					'!release/**',
					'!node_modules/**',
					'!tmp/**',
					'!*.json',
					'!*.sublime*',
					'!.DS_Store',
					'!.gitattributes',
					'!.gitignore',
					'!composer.lock',
					'!gruntfile.js',
					'!package.json'
				],
				dest: '<%= paths.release %><%= pkg.nameDashed %>-<%= pkg.version %>'
			}
		]
	}
};
