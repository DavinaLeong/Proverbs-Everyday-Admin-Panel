/**********************************************************************************
	- File Info -
		File name		: gulpfile.jpg
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 20 Dec 2016

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/

var gulp = require('gulp');
var clean_css = require('gulp-clean-css');
var sass = require('gulp-sass');
var concat = require('gulp-concat');
var sourcemaps = require('gulp-sourcemaps');
var uglify = require('gulp-uglify');
var plumber = require('gulp-plumber');
var rename = require('gulp-rename');
var del = require('del');

const NODE_PATH = './node_modules/';
const VENDOR_PATH = './vendor/';
const SCRIPT_GENERATOR_PATH = './script_generator/';

gulp.task('default', ['update-vendor', 'minify-css', 'watch']);

gulp.task('watch', function()
{
	gulp.watch('pe/sass/*.scss', ['sass']);
	gulp.watch('pe/css/*.css', ['minify-css']);
});

gulp.task('minify-css', ['sass'], function()
{
	gulp.src('pe/css/*.css')
		.pipe(clean_css({compatibility: 'ie8'}))
		.pipe(rename({suffix: '.min'}))
		.pipe(gulp.dest('pe/dist'));
});

gulp.task('sass', function()
{
	gulp.src('pe/sass/proverbs_everyday.scss')
		.pipe(sass().on('error', sass.logError))
		.pipe(gulp.dest('pe/css'));
});

// === manage vendor resources started ===
gulp.task('update-vendor', ['clean-vendor', 'copy-vendor']);

gulp.task('copy-vendor', function()
{
	console.log('--- task: copy-vendor STARTED');

	// --- jQuery ---
	gulp.src([
		NODE_PATH + 'jquery/dist/jquery.min.js'
	]).pipe(gulp.dest(VENDOR_PATH + 'jquery'));
	console.log('~ copied jQuery files.');

	// --- Twitter Bootstrap ---
	gulp.src([
		NODE_PATH + 'bootstrap/dist/css/bootstrap.min.css'
	]).pipe(gulp.dest(VENDOR_PATH + 'bootstrap/css'));
	gulp.src([
		NODE_PATH + 'bootstrap/dist/js/bootstrap.min.js'
	]).pipe(gulp.dest(VENDOR_PATH + 'bootstrap/js'));
	gulp.src([
		NODE_PATH + 'bootstrap/dist/fonts'
	]).pipe(gulp.dest(VENDOR_PATH + 'bootstrap/fonts'));
	console.log('~ copied Bootstrap files.');

	// --- Font-Awesome ---
	gulp.src([
		NODE_PATH + 'font-awesome/css/font-awesome.min.css'
	]).pipe(gulp.dest(VENDOR_PATH + 'font-awesome/css'));
	gulp.src([
		NODE_PATH + 'font-awesome/fonts/**'
	]).pipe(gulp.dest(VENDOR_PATH + 'font-awesome/fonts'));
	console.log('~ copied Font Awesome files.');

	// --- SB Admin 2 ---
	gulp.src([
		NODE_PATH + 'sb-admin-2/dist/css/sb-admin-2.min.css'
	]).pipe(gulp.dest(VENDOR_PATH + 'sb-admin-2/dist/css'));
	gulp.src([
		NODE_PATH + 'sb-admin-2/dist/js/sb-admin-2.min.js'
	]).pipe(gulp.dest(VENDOR_PATH + 'sb-admin-2/dist/js'));
	gulp.src([
		NODE_PATH + 'sb-admin-2/vendor/datatables*/**'
	]).pipe(gulp.dest(VENDOR_PATH + 'sb-admin-2/vendor'));
	gulp.src([
		NODE_PATH + 'sb-admin-2/vendor/metisMenu/**'
	]).pipe(gulp.dest(VENDOR_PATH + 'sb-admin-2/vendor/metisMenu'));
	console.log('~ copied SB Admin 2 files.');

	// --- ParsleyJS end ---
	gulp.src([
		NODE_PATH + 'parsleyjs/dist/parsley.min.js',
		NODE_PATH + 'parsleyjs/dist/parsley.min.js.map'
	]).pipe(gulp.dest(VENDOR_PATH + 'parsleyjs'));
	console.log('~ copied ParsleyJs files.');

	console.log('--- task: copy-vendor ENDED');
});

gulp.task('clean-vendor', function()
{
	console.log('--- task: clean-vendor STARTED ---');

	del.sync([
		VENDOR_PATH + 'bootstrap/**',
		VENDOR_PATH + 'font-awesome/**',
		VENDOR_PATH + 'jquery/**',
		VENDOR_PATH + 'parsleyjs/**',
		VENDOR_PATH + 'sb-admin-2/**',
		'!' + VENDOR_PATH
	]);

	console.log('--- task: clean-vendor ENDED ---');
});
// === manage vendor resources end ===