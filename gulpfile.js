var gulp = require( 'gulp' );
var rename = require( 'gulp-rename' );
var sass = require( 'gulp-sass' );
var uglify = require( 'gulp-uglify' );
var concat = require( 'gulp-concat' );
var autoprefixer = require( 'gulp-autoprefixer' );
var sourcemaps = require( 'gulp-sourcemaps' );
var browserify = require( 'browserify' );
var babelify = require( 'babelify' );
var source = require( 'vinyl-source-stream' );
var buffer = require( 'vinyl-buffer' );
var browserSync = require( 'browser-sync' ).create();
var reload = browserSync.reload;
var localhost = 'http://localhost/leon';

var phpWatch = '**/*.php';

var styleSRC = 'assets/scss/style.scss';
var styleDIST = './';
var styleWatch = 'assets/scss/**/*.scss';

var jsSRC = 'assets/js/modules/*.js';
var jsDIST = './assets/js/';

gulp.task('style', async function() {
	gulp.src( styleSRC )
		.pipe( sourcemaps.init() )
		.pipe( sass({
			errorLogToConsole: true,
			outputStyle: 'compressed'
		}) )
		.on( 'error', console.error.bind( console ) )
		.pipe( autoprefixer({ 
			overrideBrowserslist: ['last 3 versions'],
            cascade: false 
		}) )
		.pipe( rename( { suffix: '.min' } ) )
		.pipe( sourcemaps.write( './' ) )
		.pipe( gulp.dest( styleDIST ) )
		.pipe(browserSync.stream());
});

gulp.task('js', async function() {
	gulp.src( jsSRC )
		.pipe( concat('scripts.min.js') )
		.pipe( uglify() )
		.pipe( gulp.dest( jsDIST ) )
});

gulp.task('watch', async function() {
	browserSync.init({
		notify: false,
        proxy: localhost,
        ghostMode: false
	  });

	gulp.watch( phpWatch, async function php_watch() {
		browserSync.reload();
	});

	gulp.watch( styleWatch, gulp.parallel('style') );
	gulp.watch( jsSRC, gulp.parallel('js') );
});