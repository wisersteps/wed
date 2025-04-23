module.exports = function( grunt ) {
    'use strict';

    grunt.initConfig( {
        pkg: grunt.file.readJSON( 'package.json' ),

        sass: {
            dist: {
                options: {
                    style: 'expanded',
                    sourcemap: 'none'
                },
                files: {
                    'assets/css/style.css': 'assets/scss/style.scss',
                    'assets/css/admin.css': 'assets/scss/admin.scss'
                }
            }
        },

        cssmin: {
            target: {
                files: {
                    'assets/css/style.min.css': 'assets/css/style.css',
                    'assets/css/admin.min.css': 'assets/css/admin.css'
                }
            }
        },

        uglify: {
            options: {
                mangle: false
            },
            my_target: {
                files: {
                    'assets/js/script.min.js': ['assets/js/script.js'],
                    'assets/js/admin.min.js': ['assets/js/admin.js']
                }
            }
        },

        watch: {
            css: {
                files: ['assets/scss/**/*.scss'],
                tasks: ['sass', 'cssmin']
            },
            js: {
                files: ['assets/js/**/*.js', '!assets/js/**/*.min.js'],
                tasks: ['uglify']
            }
        }
    } );

    // Load NPM tasks
    grunt.loadNpmTasks( 'grunt-contrib-sass' );
    grunt.loadNpmTasks( 'grunt-contrib-cssmin' );
    grunt.loadNpmTasks( 'grunt-contrib-uglify' );
    grunt.loadNpmTasks( 'grunt-contrib-watch' );

    // Register tasks
    grunt.registerTask( 'default', ['sass', 'cssmin', 'uglify'] );
}; 