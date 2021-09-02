var gulp = require( 'gulp' ),
  plumber = require( 'gulp-plumber' ),
  autoprefixer = require('gulp-autoprefixer'),
  watch = require( 'gulp-watch' ),
  livereload = require( 'gulp-livereload' ),
  minifycss = require( 'gulp-minify-css' ),
  uglify = require( 'gulp-uglify' ),
  rename = require( 'gulp-rename' ),
  notify = require( 'gulp-notify' ),
  sass = require( 'gulp-sass' );

// Default error handler
var onError = function( err ) {
  console.log( 'An error occured:', err.message );
  this.emit('end');
}


// As with javascripts this task creates two files, the regular and
// the minified one. It automatically reloads browser as well.
gulp.task('style', function() {
  return gulp.src('./assets/css/style.scss')
    .pipe( plumber( { errorHandler: onError } ) )
    .pipe( sass() )
    .pipe( gulp.dest( '.' ) )
    // Normal done, time to do minified (style.min.css)
    // remove the following 3 lines if you don't want it
    .pipe( rename( { suffix: '.min' } ) )
    .pipe( minifycss({keepSpecialComments: 1}) )
    .pipe( gulp.dest( '.' ) )
    .pipe( livereload() );
});

// Start the livereload server and watch files for change
gulp.task( 'watch', function() {
  livereload.listen();

  // don't listen to whole js folder, it'll create an infinite loop
  //gulp.watch( [ './js/**/*.js', '!./js/dist/*.js' ], [ 'scripts' ] )

  gulp.watch( './assets/css/*.scss', ['style'] );


  //gulp.watch( './**/*.php' ).on( 'change', function( file ) {
    // reload browser whenever any PHP file changes
  //  livereload.changed( file );
  //} );
} );


gulp.task( 'default', ['watch'], function() {
 // Does nothing in this task, just triggers the dependent 'watch'
} );