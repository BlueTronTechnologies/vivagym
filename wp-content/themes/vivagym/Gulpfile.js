'use strict';
var gulp = require('gulp');
var sass = require('gulp-sass');
var plumber = require('gulp-plumber');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var sourcemaps = require('gulp-sourcemaps');
var cleanCSS = require('gulp-clean-css');

gulp.task('sass', function () {
  return gulp.src('./scss/**/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
    .pipe(cleanCSS())
    .pipe(sourcemaps.write('./maps'))
    .pipe(gulp.dest('./css'));
});

gulp.task('sass:watch', function () {
  gulp.watch('./scss/**/*.scss', ['sass']);
});

gulp.task('sassDev', function () {
  return gulp.src('./scss/**/*.scss')
    .pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
    .pipe(sourcemaps.write('./maps'))
    .pipe(gulp.dest('./css'));
});

gulp.task('sassDev:watch', function () {
  gulp.watch('./scss/**/*.scss', ['sassDev']);
});

gulp.task('scripts', function() {
  return gulp.src([
      './js/jquery-3.2.1.min.js',
      './js/onload.js'
    ])
    .pipe(plumber())
    .pipe(concat('scripts.js'))
    .pipe(uglify())
    .pipe(gulp.dest('./dist/js/'));
});

gulp.task('scripts:watch', function () {
  gulp.watch('./js/*.js', ['scripts']);
});

gulp.task('default', ['sass', 'sass:watch', 'scripts', 'scripts:watch']);
gulp.task('production', ['sass']);