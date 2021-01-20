var gulp = require('gulp');
var uglify = require('gulp-uglify');
var concat = require('gulp-concat');
var cleanCSS = require('gulp-clean-css');
var clean = require('gulp-clean');

gulp.task('clean', function(){
	return gulp.src('./public/assets/js/dist')
	.pipe(clean())
});

//pode usar com o clean
//gulp.task('sitejs',['clean'],function(){
	//return gulp.src('./public/assets/js/site/*.js')
	//.pipe(concat('all.js'))
	//.pipe(uglify())
	//.pipe(gulp.dest('./public/assets/js/dist/site'))
//});

gulp.task('sitejs',function(){
	return gulp.src('./public/assets/js/site/*.js')
	.pipe(concat('all.js'))
	.pipe(uglify())
	.pipe(gulp.dest('./public/assets/js/dist/site'))
});

gulp.task('alertjs',function(){
	return gulp.src('./public/assets/js/alert/*.js')
	.pipe(concat('alert.js'))
	.pipe(uglify())
	.pipe(gulp.dest('./public/assets/js/dist/alert'))
});

gulp.task('adminjs',function(){
	return gulp.src('./public/assets/js/admin/*.js')
	.pipe(concat('all.js'))
	.pipe(uglify())
	.pipe(gulp.dest('./public/assets/js/dist/admin'))
});

gulp.task('sitecss',function(){
	return gulp.src('./public/assets/css/site/*.css')
	.pipe(concat('all.css'))
	.pipe(cleanCSS({compatibility: 'ie8'}))	
	.pipe(gulp.dest('./public/assets/css/dist/site'))
});

gulp.task('watch' , function() {
   gulp.watch('./public/assets/js/site/*.js', ['sitejs']);
   gulp.watch('./public/assets/js/admin/*.js', ['adminjs']);
   gulp.watch('./public/assets/js/alert/*.js', ['alertjs']);
   gulp.watch('./public/assets/css/site/*.css', ['sitecss']);
});

gulp.task('default',['sitejs','adminjs']);