/* 
* Path to folder which contains all sass files.
* Path related to gulpfile.js location
*/
var sass_src = 'resources/assets/sass/';

/* 
* Name of the main sass file inside sass source folder
*/
var sass_main_filename = 'bootstrap';

/*
* Path to folder which will contain all result CSS files
*/
var css_dest = 'public/css/';

/* 
* Name of the main sass file inside sass source folder
*/
var css_result_filename = 'app';

/*
* List of JS files which should be concatenated.
*/
var js_concat_files = [
	'resources/assets/js/collapse.js',
	'resources/assets/js/modal.js',
	'resources/assets/js/util.js',
	'resources/assets/js/dropdown.js',
	'resources/assets/js/modules/select2.min.js',
	'resources/assets/js/modules/transliteral.js',
	'resources/assets/js/modules/uploadPreview.min.js',
	'resources/assets/js/modules/tinymce.min.js',
	'resources/assets/js/main/app.js'
];

/* 
* Concatenated JS file.
*/
var js_concat_res_path = 'public/js/';
var js_concat_res_file = 'app.js';

/*
* List of required pugins
*/
var gulp = require('gulp');
var path = require('path');
var sass  = require('gulp-sass');
var minifyCSS = require('gulp-minify-css');
var rename = require('gulp-rename');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var browserSync = require('browser-sync');



var indexFile = 'public/index.html';
var sassFiles = sass_src + '**/*.scss';
var sassMain = sass_src + '' + sass_main_filename + '.scss';

gulp.task('sass', function() {	
	return gulp.src(sassMain)
	.pipe(sass({
		generateSourceMap: true,
		      paths: [ path.join(__dirname, 'scss') ]
	}))
	.on('error', swallowError)
	.pipe(rename({
		basename: css_result_filename
	}))
	.pipe(gulp.dest(css_dest));
});

gulp.task('minify-css', function() {
	gulp.src(css_dest+css_result_filename+'.css')
    		.pipe(minifyCSS({keepBreaks:true}))
    		.pipe(rename({
    			basename: css_result_filename,
    			suffix: '.min'
    		}))
   		.pipe(gulp.dest(css_dest))
});

gulp.task('js-concat', function() {
	gulp.src(js_concat_files)
		.pipe(concat(js_concat_res_file))
		.pipe(gulp.dest(js_concat_res_path))
		.pipe(uglify())
		.pipe(rename({
			suffix: '.min'
		}))
		.pipe(gulp.dest(js_concat_res_path))
		.on('error', swallowError)
});

var localhost = '192.168.1.56';
// var localhost  = '192.168.1.18';
gulp.task('browser-sync', function() {
	browserSync({
        		/*server: {
			baseDir: './www'
		}*/
		proxy: 'fb.local'
    });
});

gulp.task('browser-reload', ['sass'], function() {
	browserSync.reload();
});


gulp.task('watch',function () { 
	gulp.start(['browser-sync','sass']);
	gulp.watch(indexFile,['browser-reload']);
	gulp.watch(sassFiles,['browser-reload']);
	gulp.watch(js_concat_files,['js-concat']);
});

gulp.task('default', ['sass','js-concat','watch']);

function swallowError (error) {
	console.log(error.toString());
	this.emit('end');
}