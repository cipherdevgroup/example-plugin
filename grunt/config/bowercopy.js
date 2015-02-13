// https://github.com/timmywil/grunt-bowercopy
module.exports = {
	options: {
		clean: true
	},
	css: {
		options: {
			destPrefix: '<%= paths.bower %>'
		},
		files: {
			bourbon: 'bourbon/app/assets/stylesheets',
			neat: 'neat/app/assets/stylesheets',
			genericons: 'genericons/genericons',
			'wp-normalize': 'wp-normalize.scss/_wp-normalize.scss'
		}
	},
	js: {
		options: {
			destPrefix: '<%= paths.bower %>'
		},
		files: {
			'fitvids/js': 'fitvids/jquery.fitvids.js',
			'accessible-menu/js': 'accessible-menu/dist',
			'sidr/js': 'sidr/jquery.sidr.min.js'
		}
	}
};
