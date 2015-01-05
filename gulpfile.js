var gulp = require('gulp');
var less = require('gulp-less');
var path = require('path');
var browserSync = require('browser-sync');
var reload      = browserSync.reload;

var lessFiles = ['src/public/css/style.less', 'src/public/css/variables.css'];
var htmlFiles = 'src/public/**/**.html';
var jsFiles = 'src/public/**/**.js';

gulp.task('default', ['browser-sync','less', 'html', 'js'], function() {
  gulp.watch(lessFiles, ['less']);
  gulp.watch(htmlFiles, ['html']);
  gulp.watch(jsFiles, ['js']);

});

gulp.task('less', function() {
  gulp.src(lessFiles)
    .pipe(less())
    .pipe(gulp.dest('src/public/css'))
    .pipe(reload({stream:true})); //Browser Sync
});

gulp.task('html', function(){
  gulp.src(htmlFiles)
  .pipe(reload({stream:true})); //Browser Sync
});

gulp.task('js', function(){
  gulp.src(jsFiles)
  .pipe(reload({stream:true})); //Browser Sync
});


gulp.task('browser-sync', function() {
    browserSync({
        proxy: "127.0.0.1"
    });
});