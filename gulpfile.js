var gulp = require('gulp');
var postcss = require('gulp-postcss');
var autoprefixer = require('autoprefixer');
var sass = require('gulp-sass');
var concat = require('gulp-concat');

gulp.task('watch', function(){
    gulp.watch('sass/*.scss', gulp.parallel('css'));
    gulp.watch('js/*.js', gulp.parallel('js'));
    gulp.watch('portal/sass/*.scss', gulp.parallel('portal_css'));
    gulp.watch('portal/js/*.js', gulp.parallel('portal_js'));
});
gulp.task('css', function(){
    var plugins = [
        autoprefixer({
            overrideBrowserslist:  ['last 2 versions'],
            cascade:false
        })
    ];
    return gulp.src([
        'css/swiper-bundle.css',
        'css/intlTelInput.css',
        'sass/app.scss'
    ])
        .pipe(sass())
        .pipe(postcss(plugins))
        .pipe(concat('app.css'))
        .pipe(gulp.dest('view'));
});
gulp.task('portal_css', function(){
    var plugins = [
        autoprefixer({
            overrideBrowserslist:  ['last 2 versions'],
            cascade:false
        })
    ];
    return gulp.src([
        'portal/sass/app.scss'
    ])
        .pipe(sass())
        .pipe(postcss(plugins))
        .pipe(concat('app.css'))
        .pipe(gulp.dest('portal/view'));
});
gulp.task( 'js', function() {
    return gulp.src([
        'js/jquery.fancybox.js',
        'js/scrollindicator.jquery.js',
        'js/swiper/swiper-bundle.js',
        'js/wow.js/dist/wow.js',
        'js/countrySelect.js',
        'js/intl-tel-input/build/js/intlTelinput.js',
        'js/jaralax.js',
        'js/sticksy.js',
        //'js/jquery.sticky.js',
        'js/common.js',
        'js/main.js'
    ])
        .pipe(concat('app.js'))
        .pipe(gulp.dest('view'));
});
gulp.task( 'portal_js', function() {
    return gulp.src([
        'portal/js/jquery.fancybox.js',
        'portal/js/main.js'
    ])
        .pipe(concat('app.js'))
        .pipe(gulp.dest('portal/view'));
});
