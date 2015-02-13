// https://github.com/ahmednuaman/grunt-scss-lint
module.exports = {
	options: {
		config: '.scss-lint.yml',
		reporterOutput: null
	},
	assets: ['<%= paths.authorAssets %>scss/**/*.scss']
};
