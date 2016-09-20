var gulp        = require('gulp');
var browserSync = require('browser-sync').create();
var sass        = require('gulp-sass');
var bourbon = require('node-bourbon').includePaths;

// Сервер + отслеживание sass/html/php файлов
gulp.task('serve', ['scss'], function() {

    browserSync.init({
        //server: "./"
        proxy: "imageforest.loc"
    });

    gulp.watch("scss/*.scss", ['scss']);
    gulp.watch("*.html").on('change', browserSync.reload);
	gulp.watch("css/*.css").on('change', browserSync.reload);
    gulp.watch("*.php").on('change', browserSync.reload);
    gulp.watch("js/*.js").on('change', browserSync.reload);
});

// Компиляция scss в CSS и auto-inject в браузеры
gulp.task('scss', function() {
    return gulp.src("scss/main.scss") 
    .pipe(sass({
        includePaths: ['main'].concat(bourbon)
        }).on('error', sass.logError))
        .pipe(gulp.dest("./css/"))
        .pipe(browserSync.stream());
});

gulp.task('default', ['serve']);