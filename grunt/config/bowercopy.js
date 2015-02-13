// https://github.com/timmywil/grunt-bowercopy
module.exports = {
	options: {
		clean: true,
		destPrefix: '<%= paths.bower %>'
	},
	css: {
		files: {
			bourbon: 'bourbon/app/assets/stylesheets',
			neat: 'neat/app/assets/stylesheets',
			'wp-normalize': 'wp-normalize.scss/_wp-normalize.scss'
		}
	}
	//js: {
	//	files: {}
	//}
};
