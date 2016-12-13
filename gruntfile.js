module.exports = function (grunt) {

	grunt.initConfig({

		pkg: grunt.file.readJSON('package.json'),

// Compile SASS files into minified CSS.

		sass: {
			dist: {
				options: {
					style: 'expanded',
					lineNumbers: false,
					update: true
				},

				files: {
					'css/screen.css': 'sass/screen.scss'
				}
			}
		},

// Watch these files and notify of changes.

		watch: {
			//grunt: { files: ['Gruntfile.js'] },
			files: [
				'inc/*.php',
				'./*.php'
			],
			sass: {
				files: [
					'sass/**/*.scss'
				],
				tasks: ['sass']
			}
		},

		browserSync: {
			bsFiles: {
				src : [
					'./css/*.css',
					'./inc/*.php',
					'./*.php'
				]
			},
			options: {
				watchTask: true,
				proxy: "spinemed.local",
				port: "8080",
				notify: false,
				browser: "chrome"
			}
		},

		php2html: {
			options: {
				// Task-specific options go here.
				processLinks: true,
				htmlhint: false /*{
				 'tagname-lowercase': true,
				 'attr-lowercase': true,
				 'attr-value-double-quotes': false,
				 'doctype-first': true,
				 'tag-pair': true,
				 'spec-char-escape': true,
				 'id-unique': false,
				 'src-not-empty': true
				 }*/
			},
			watcher: {
				files: [
					{
						expand: true,
						cwd: './',
						src: ['./*.php', '!./head.php', '!./footer.php'],
						dest: 'build',
						ext: '.html'
					}
				]
			}
		},

		htmllint: {
			files: {
				src: ['./build/*.html']
			},

			options: {
				force: true,
				reporter: 'checkstyle',
				reporterOutput: './htmlCheck.html',
				absoluteFilePathsForReporter: true,
				ignore: [   'Bad value “fancybox-thumb” for attribute “rel” on element “a”: The string “fancybox-thumb” is not a registered keyword.',
							'Forbidden code point U+0003.'
				]
			}
		},

		copy: {
/*			css: {
				files: [
					{
						expand: true,
						src: ['css/screen.css'],
						dest: 'build/',
						filter: 'isFile'
					}
				]
			},*/
			fonts: {
				files: [
					{
						expand: true,
						src: ['fonts/*'],
						dest: 'build/',
						filter: 'isFile'
					}
				]
			},
			img: {
				files: [
					{
						expand: true,
						src: ['img/**'],
						dest: 'build/'
					}
				]
			},
			js: {
				files: [
					{
						expand: true,
						src: ['js/*'],
						dest: 'build/',
						filter: 'isFile'
					}
				]
			}
		},

		"file-creator": {
			"mainfle": {
				files: [
					{
						file: "./" + (grunt.option('option-name') + ".php"),
						method: function(fs, fd, done) {
							fs.writeSync(fd, "<?php\n");
							fs.writeSync(fd, "include('head.php');\n");
							// fs.writeSync(fd, "include('inc/menu-line.php');\n");
							fs.writeSync(fd, "include('inc/page-" + (grunt.option('option-name')) + ".php');\n");
							fs.writeSync(fd, "include('footer.php');");
							done();
						}
					}
				]
			},

			"include": {
				files: [
					{
						file: "inc/page-" + (grunt.option('option-name') + ".php") ,
						method: function(fs, fd, done) {
							fs.writeSync(fd, ' ');
							done();
						}
					}
				]
			},

			"sass": {
				files: [
					{
						file: "sass/_page-" + (grunt.option('option-name') + ".scss") ,
						method: function(fs, fd, done) {
							fs.writeSync(fd, "@import 'variables';");
							done();
						}
					}
				]
			}
		},

		purifycss: {
			options: {},
			target: {
				src: ['build/*.html', 'js/*.js'],
				css: ['css/screen.css'],
				dest: 'build/css/screen.css'
			}
		}
	});

// Load externally defined tasks.

	grunt.loadNpmTasks('grunt-contrib-sass');

	grunt.loadNpmTasks('grunt-php2html');

	grunt.loadNpmTasks('grunt-html');

	grunt.loadNpmTasks('grunt-purifycss');

	grunt.loadNpmTasks('grunt-contrib-watch');

	grunt.loadNpmTasks('grunt-browser-sync');

	grunt.loadNpmTasks('grunt-file-creator');

	grunt.loadNpmTasks('grunt-contrib-copy');


// Establish tasks we can run from the terminal.


	grunt.registerTask('valid', ['php2html', 'htmllint']);

	grunt.registerTask('build', ['php2html', 'copy', 'htmllint', 'purifycss']);

	grunt.registerTask('default', ['sass', 'browserSync', 'watch']);

};



