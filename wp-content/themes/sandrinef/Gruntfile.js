module.exports = function (grunt) {

    // Project configuration.
    grunt.initConfig({
        browserSync: {
            dev: {
                bsFiles: {
                    src: ['style.css', 'js/script.js', '*.php', '**/*.php']
                },
                options: {
                    watchTask: true,
                    notify: false,
                    proxy: "localhost:8080"
                }
            }
        },
        watch: {
            scss: {
                files: ['build/scss/*.scss', '!build/scss/style.scss'],
                tasks: ['build-css'],
            },
            js: {
                files: ['build/js/*.js'],
                tasks: ['build-js'],
            },
            options: {
                interrupt: true
            }
        },
        sass: {
            dist: {
                options: {
                    style: 'expanded'
                },
                files: {
                    'build/css/style.css': 'build/scss/style.scss'
                }
            }
        },
        // concat js and css
        concat: {
            js: {
                
                src: ['build/js/*.js'], 
                dest: 'js/script.js'
            },
            css: {
                src: ['build/css/config-theme.css',  'build/css/*.css'],     
                dest: 'build/concat.css'
            },
            sass: {
                src: [ 'build/scss/_global.scss', 'build/scss/*.scss','!build/scss/style.scss', '!build/scss/variables.scss'],
                dest: 'build/scss/style.scss'
            }
        },
        //minify js
        // uglify: {
        //     my_target: {
        //         files: {
        //             'js/script.js': ['build/all.js']
        //         }
        //     }
        // },
        //minify css
        cssmin: {
            target: {
                files: {
                    'style.css': ['build/concat.css']
                }
            }
        }
    }); 

    // Load the plugins
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-browser-sync');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.registerTask('default', ['browserSync', 'watch']);
    grunt.registerTask('build-css', ['concat:sass', 'sass', 'concat:css', 'cssmin']);
    grunt.registerTask('build-js', ['concat:js']);

}