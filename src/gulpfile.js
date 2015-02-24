var gulp = require('gulp');
var less = require('gulp-less');
var path = require('path');
var browserSync = require('browser-sync');
var reload      = browserSync.reload;
var shell = require('gulp-shell')

var lessFiles = ['/vagrant/src/resources/assets/less/admin.less', '/vagrant/src/resources/assets/less/variables.less'];
var htmlFiles = ['/vagrant/src/public/**/**', '/vagrant/src/resources/**/**.php'];
var jsFiles = '/vagrant/src/public/**/**.js';

gulp.task('default', ['bowercopy', 'browser-sync','less', 'js'], function() {


  gulp.watch(lessFiles, ['less']);
  gulp.watch(htmlFiles).on('change', reload);
  gulp.watch(jsFiles, ['js']);

});

gulp.task('less', function() {
  gulp.src('/vagrant/src/resources/assets/less/admin.less')
    .pipe(less())
    .pipe(gulp.dest('/vagrant/src/public/css/'))
    .pipe(reload({stream:true})); //Browser Sync
});

gulp.task('bowercopy', ['bowerUpdate'],function(){
  gulp.src([
    '/vagrant/src/bower_components/angular/angular.js',
    '/vagrant/src/bower_components/angular-bootstrap/ui-bootstrap.js',
    '/vagrant/src/bower_components/angular-loading-bar/build/loading-bar.js',
    '/vagrant/src/bower_components/lodash/dist/lodash.js',
    '/vagrant/src/bower_components/restangular/dist/restangular.js']
    )
  .pipe(gulp.dest('/vagrant/src/public/js/'))

  gulp.src('/vagrant/src/bower_components/angular-loading-bar/src/loading-bar.css')
  .pipe(gulp.dest('/vagrant/src/public/css/'))

});

gulp.task('bowerUpdate', shell.task([
  'cd /vagrant/src; /usr/local/bin/bower install'
]));

gulp.task('js', function(){
  gulp.src(jsFiles)
  .pipe(reload({stream:true})); //Browser Sync
});


gulp.task('browser-sync', function() {
    browserSync({
        proxy: "127.0.0.1"
    });
});