module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    sass: {
      options: {
        includePaths: ['assets/bower_components/foundation/scss']
      },
      dev: {
        options: {
          style: 'expanded',
          sourceMap: true,
        },
        files: {
          'assets/css/app.css': 'assets/scss/app.scss'
        }
      },
      dist: {
        options: {
          outputStyle: 'compressed',
          sourceMap: true,
        },
        files: {
          'assets/css/app.min.css': 'assets/scss/app.scss',
          'assets/css/app.ie.css': 'assets/scss/app.scss'
        }
      }
    },

    //autoprefixer
    postcss: {
      options: {
        map: true,
        processors: [
          require('autoprefixer')({browsers: ['last 2 versions', 'ie 8', 'ie 9', '> 1%']})
        ]
      },
      //prefix all files
      multiple_files: {
        expand: true,
        flatten: true,
        src:'assets/css/*.css',
        dest:'assets/css/',
      }
    },

     //imagemin
    imagemin: {
       dist: {
          options: {
            optimizationLevel: 5
          },
          files: [{
             expand: true,
             cwd: 'assets/images',
             src: ['**/*.{png,jpg,gif}'],
             dest: 'assets/images'
          }]
       }
    },

      //Copy js files
    copy: {
        fontawesome: {
            expand: true,
            flatten: true,
            src: ['assets/bower_components/font-awesome/fonts/*'],
            dest: 'assets/fonts'
        },
        headroom: {
            cwd: 'assets/bower_components/headroom.js/dist/',  // set working folder / root to copy
            src: 'headroom.js',           // copy all files and subfolders
            dest: 'assets/js/',    // destination folder
            expand: true           // required when using cwd
        },
         fastclick: {
            cwd: 'assets/bower_components/fastclick/lib/',  // set working folder / root to copy
            src: 'fastclick.js',           // copy all files and subfolders
            dest: 'assets/js/',    // destination folder
            expand: true           // required when using cwd
        },
        foundation: {
            expand: true,
            flatten: true,
            src: ['assets/bower_components/foundation/js/*'],
            dest: 'assets/js'
        },
        foundation_plugins: {
            expand: true,
            flatten: true,
            src: ['assets/bower_components/foundation/js/foundation/*'],
            dest: 'assets/js/foundation'
        },        
        modernizr: {
            expand: true,
            flatten: true,
            src: ['assets/bower_components/modernizr/modernizr.js'],
            dest: 'assets/js/'
        }
    },

    //browserSync
    browserSync: {
        dev: {
            bsFiles: {
                    src : [
                        'assets/css/*.css',
                        '**/*.php',
                        'assets/js/*.js',
                        'assets/images/**/*.{png,jpg,jpeg,gif,webp,svg}'
                    ]
            },
            options: {
                watchTask: true,
                proxy: "bicycle.dev/magazine"
            }
        }
    },

    //minify js with uglify
     uglify: {
        dist: {
        options: {
          mangle: false,
          compress: true
        },
        files: {
          "assets/js/modernizr.min.js": ["assets/js/modernizr.js"],
          "assets/js/foundation.min.js": ["assets/js/foundation.js"],
          "assets/js/asmag_custom.min.js": ["assets/js/asmag_custom.js"],
          "assets/js/asmag_feature.min.js": ["assets/js/asmag_feature.js"],
          "assets/js/asmag_front.min.js": ["assets/js/asmag_front.js"],
        }
      },
    },

    watch: {
      grunt: {
        options: {
          reload: true
        },
        files: ['Gruntfile.js']
      },

      sass: {
        files: 'assets/scss/**/*.scss',
        tasks: ['sass', 'postcss',]
      }
    }
  });

  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-postcss');
  grunt.loadNpmTasks('grunt-contrib-imagemin');
  grunt.loadNpmTasks('grunt-browser-sync');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.registerTask('build', ['sass']);
  grunt.registerTask('default', ['sass','browserSync','copy','watch']);
}
