module.exports = function(grunt) {

    grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		uglify: {
			my_target: {
				files: {
					'scripts/scripts.js': ['components/javascript-to-compile/_scripts-staging.js']
				} //files
			} //my_target
		}, //uglify		

		/* Sass */
		sass: {
		  dev: {
		    options: {
		      style: 'expanded',
		      sourcemap: 'none'
		    },
		    files: {
		      'style-expanded.css': 'components/sass/style-darkmode.scss', // default is Darkmode
          'style-spring-expanded.css': 'components/sass/style-spring.scss',
          'style-classic-expanded.css': 'components/sass/style-classic.scss'
		    }
		  },
		  dist: {
		  	options: {
		  		style: 'compressed',
		  		sourcemap: 'none'
		  	},
		  	files: {
		  		'style.css': 'components/sass/style-darkmode.scss', // default is Darkmode
		  		'style-spring.css': 'components/sass/style-spring.scss',
		  		'style-classic.css': 'components/sass/style-classic.scss'
		  	}
		  }
		},
		/* Autoprefixer */
		autoprefixer: {
			options: {
				browsers: ['last 8 versions']
			},
			// prefix all files
			multiple_files: {
				expanded: true, 
				flatten: true,
				src: '*.css',
				dist: ''
			}
		},

	  	/* Watch */
		watch: {
			options: { livereload: true },
			scripts: {
				files: ['components/javascript-to-compile/_scripts-staging.js'],
				tasks: ['uglify']
			}, //scripts			
			css: {
				files: '**/*.scss',
				tasks: ['sass','autoprefixer']
			}, // css
			hypertext: {
				files: ['*.php','*.htm','_includes/*.php','_logged_in/*.php', 'nav/*.php']
			} //hypertext
		}, //watch

	});
	grunt.loadNpmTasks('grunt-contrib-uglify'); //uglify minifies js upon save
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-autoprefixer');
	grunt.registerTask('default',['watch']);
}