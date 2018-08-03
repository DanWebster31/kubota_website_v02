// Include gulp
var gulp = require('gulp');

// Include Our Plugins
var sass = require('gulp-sass');
var plumber = require('gulp-plumber');

var sassOptions = {
    errLogToConsole: true,
    outputStyle: 'compressed' // Styles: nested, compact, expanded, compressed
};

// Compile Sass file to CSS, and reload browser(s).
gulp.task('sass', function() {
    return gulp.src('includes/scss/*.scss')
        .pipe(plumber())
        .pipe(sass.sync(sassOptions))
        .pipe(sass.sync().on('error', sass.logError))
        .pipe(gulp.dest('includes/css'));

});

// Watch Files For Changes
gulp.task('watch', function() {
  gulp.watch('includes/scss/**/*.scss', ['sass']);
});

// Default Task
gulp.task('serve', ['sass', 'watch']);
