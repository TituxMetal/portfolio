'use strict';

var gulp        = require('gulp'),
		babel				= require("gulp-babel"),
    sass        = require('gulp-sass'),
    cssmin      = require('gulp-cssmin'),
    rename      = require('gulp-rename'),
    prefix      = require('gulp-autoprefixer'),
    uglify      = require('gulp-uglify'),
    concat      = require('gulp-concat'),
    imagemin    = require('gulp-imagemin'),
    browserSync = require('browser-sync').create();

// Configure CSS tasks.
gulp.task('sass', function () {
  return gulp.src('resources/assets/scss/**/*.scss')
    .pipe(sass.sync().on('error', sass.logError))
    .pipe(prefix('last 2 versions'))
    .pipe(cssmin())
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest('public/assets/css'));
});

// Configure JS.
gulp.task('js', function() {
  return gulp.src('resources/assets/js/**/*.js')
    .pipe(babel())
    .pipe(uglify())
    .pipe(concat('app.js'))
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest('public/assets/js'))
    .pipe(browserSync.stream());
});

// Configure image stuff.
gulp.task('images', function () {
  return gulp.src('resources/assets/img/**/*.+(png|jpg|gif|svg)')
    .pipe(imagemin())
    .pipe(gulp.dest('public/assets/img'));
});

gulp.task('watch', function () {
  gulp.watch('resources/assets/scss/**/*.scss', ['sass']);
  gulp.watch('resources/assets/js/**/*.js', ['js']);
});

gulp.task('default', ['sass', 'js', 'images']);
