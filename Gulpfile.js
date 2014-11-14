var gulp = require('gulp');
var less = require('gulp-less');
var rename = require('gulp-rename');
var concat = require('gulp-concat');
var download = require('gulp-download');
var unzip = require('gulp-unzip');
var run = require('gulp-run');
var newer = require('gulp-newer');
var livereload = require('gulp-livereload');
//var elixir = require('laravel-elixir');

/*
 |----------------------------------------------------------------
 | Have a Drink!
 |----------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic
 | Gulp tasks for your Laravel application. Elixir supports
 | several common CSS, JavaScript and even testing tools!
 |
 */

/*elixir(function(mix) {
    mix.sass("bootstrap.scss")
       .routes()
       .events()
       .phpUnit();
});*/

/////////////////       VARS        //////////////

var adminCssSrc = ['./public/css/admin/style.less'];
var adminCssDest = './public/css/admin';
var frontCssSrc = ['./public/css/style.less'];
var frontCssDest = './public/css';

var jsAdminProdsrc = ['./bower_components/jquery/dist/jquery.min.js', './public/js/admin/myscript.js']
var jsAdminProdDest = './public/js/admin/';
var jsAdminFinalName = 'script-prod.js';

var jsAdminJqueryDevelSrc = './bower_components/jquery/src/jquery.js'
var jsAdminJqueryDevelFinalName = 'jquery-devel.js'
var jsAdminJqueryDevelDest = './public/js/admin/'



////////////////      end VARS     //////////////


/////////////////// MAIN SCRIPTS - The ones you want to run directly ////////////////

gulp.task('default', ['css', 'js'], function(){});

gulp.task('update', ['downloadVendor', 'gitPull', 'dbMigrations', 'scanRoutes', 'updateBower'],function(){})

gulp.task('watch', ['assetPublish'], function(){
	console.log('watching js and less for changes...');
	var watchLess = [].concat(adminCssSrc).concat(frontCssSrc)
	var watchJs = [].concat(jsAdminProdsrc).concat(jsAdminJqueryDevelSrc)
	
	gulp.watch(watchLess, ['css', 'assetPublish'])
	gulp.watch(watchJs, ['js', 'assetPublish'])


})

////////////////// End Main Scripts ///////////////


gulp.task('css', function(){
	
		gulp.src(adminCssSrc)
		.pipe(newer(adminCssDest+'/style.css'))
		.pipe(less())
		.pipe(gulp.dest(adminCssDest))
		.pipe(livereload());

		gulp.src(frontCssSrc)
		.pipe(newer(frontCssDest+'/style.css'))
		.pipe(less())
		.pipe(gulp.dest(frontCssDest))
		.pipe(livereload());


});

gulp.task('js', function(){
	gulp.src(jsAdminProdsrc)
	.pipe(newer(jsAdminProdDest+jsAdminFinalName))
	.pipe(concat(jsAdminFinalName))
	.pipe(gulp.dest(jsAdminProdDest))
	.pipe(livereload());


	gulp.src(jsAdminJqueryDevelSrc)
	.pipe(rename(jsAdminJqueryDevelFinalName))
	.pipe(newer(jsAdminJqueryDevelDest+jsAdminJqueryDevelFinalName))
	.pipe(gulp.dest(jsAdminJqueryDevelDest))
	.pipe(livereload());

	//TODO Add bootstrap scripts

});

gulp.task('assetPublish', function(){
	var cmd = new run.Command('php ../../../artisan asset:publish --bench="fimdomeio/caravel"');
	cmd.exec();          

});

gulp.task('downloadVendor', function(){
		download('http://fimdomeio.com/p/Caravel/latest-vendor.zip')
		.pipe(unzip())
		.pipe(gulp.dest('./'));
})

gulp.task('gitPull', function(){
	var cmd = new run.Command('git pull');
	cmd.exec();          
})

gulp.task('dbMigrations', ['touchDB'], function(){
	var cmd = new run.Command('php artisan migrate');  // Create a command object for `cat`.
	cmd.exec();           // Call `cat` with 'hello world' on stdin.
})

gulp.task('touchDB', function(){
	var cmd = new run.Command('touch storage/database.sqlite');
	cmd.exec();
})

gulp.task('scanRoutes', function(){
	var cmd = new run.Command('php artisan route:scan');
	cmd.exec();
})

gulp.task('updateBower', function(){
	var cmd = new run.Command('bower install');
	cmd.exec();
})

