// https://github.com/ariya/grunt-jsvalidate
module.exports = {
	options: {
		verbose: true
	},
	assets: {
		files: {
			src: ['<%= paths.authorAssets %>js/{,*/}*.js']
		}
	},
	plugin: {
		files: {
			src: ['<%= paths.plugin %>js/{,*/}*.js']
		}
	},
	grunt: {
		files: {
			src: ['<%= files.grunt %>', '<%= files.config %>']
		}
	}
};
