const {src, dest, watch, series, minifyImg} = require('gulp');
var gulp = require('gulp');
//const sass = require('gulp-sass');
const sass = require('gulp-sass')(require('sass'));
const postcss = require('gulp-postcss');
const cssnano = require('cssnano');
const terser = require('gulp-terser');
const browsersync = require('browser-sync').create();
var imagemin = require('gulp-tinypng');

// Image Minify
gulp.task('tinypng', function () {
  gulp
    .src('images/*')
    .pipe(imagemin('xLZm5mwK29jwTsPrdxt9Qqj5tBtNKRdN'))
    .pipe(gulp.dest('dist'));
});
//npm install --save-dev gulp-tinypng
// gulp tinypng command note: image type only png or jpeg not svg
// Sass Task
function scssTask() {
  return src('app/scss/style.scss', {sourcemaps: true})
    .pipe(sass())
    .pipe(postcss([cssnano()]))
    .pipe(dest('css', {sourcemaps: '.'}));
}

// JavaScript Task
 function jsTask() {
  return src('app/js/custom.js', {sourcemaps: true})
    .pipe(terser())
    .pipe(dest('js', {sourcemaps: '.'}));
} 

// Browsersync Tasks
function browsersyncServe(cb) {
  browsersync.init({
    server: {
      baseDir: '.',
    },
  });
  cb();
}

function browsersyncReload(cb) {
  browsersync.reload();
  cb();
}

// Watch Task
function watchTask() {
  watch('*.html', browsersyncReload);
  watch(
    ['app/scss/**/*.scss', 'app/js/**/*.js'],
    series(scssTask, jsTask, browsersyncReload)
  );
}

exports.scssTask = scssTask;
exports.jsTask = jsTask;

// Default Gulp task
exports.default = series(scssTask, jsTask, browsersyncServe, watchTask);
