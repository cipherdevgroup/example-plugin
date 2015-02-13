// https://github.com/gruntjs/grunt-contrib-clean
module.exports = {
	bower: {
		src: [
			'<%= paths.bower %>'
		]
	},
	composer: {
		src: [
			'<%= paths.composer %>'
		]
	},
	css: {
		src: [
			'<%= paths.plugin %>css'
		]
	},
	dist: {
		src: [
			'<%= paths.dist %>'
		]
	},
	docs: {
		src: [
			'<%= paths.docs %>'
		]
	},
	font: {
		src: [
			'<%= paths.plugin %>font'
		]
	},
	logs: {
		src: [
			'<%= paths.logs %>'
		]
	},
	tmp: {
		src: [
			'<%= paths.tmp %>'
		]
	},
	js: {
		src: [
			'<%= paths.plugin %>js'
		]
	},
	images: {
		src: [
			'<%= paths.plugin %>images'
		]
	},
	languages: {
		src: [
			'<%= paths.plugin %>languages'
		]
	},
	style: {
		src: [
			'<%= paths.plugin %>style*.*',
			'<%= paths.tmp %>style*.*'
		]
	},
	screenshot: {
		src: [
			'<%= paths.plugin %>screenshot.png'
		]
	}

};
