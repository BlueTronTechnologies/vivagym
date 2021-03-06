var gulp          = require('gulp');
var sass          = require('gulp-sass');
var watch         = require('gulp-watch');
var browserSync   = require('browser-sync');
var csso          = require('gulp-csso');
var postcss       = require('gulp-postcss');
var autoprefixer  = require('autoprefixer');
var webpack       = require('webpack');
var webpackStream = require('webpack-stream-fixed');

//et added
var plumber = require('gulp-plumber');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');

function swallowError (error) {
    //Prints details of the error in the console
    console.log(error.toString());
    this.emit('end')
}

gulp.task('sass', function() {
    gulp.src('./assets/scss/app/app.scss')
        .pipe(sass())
        .on('error', swallowError)
        .pipe(postcss([ autoprefixer() ]))
        .pipe(gulp.dest('./public/css'))
        //For auto injecting the CSS into the browser. 
        .pipe(browserSync.stream({match: '**/*.css'}));
});

gulp.task('sass-vendor', function() {
    gulp.src('./assets/scss/vendor/vendor.scss')
        .pipe(sass())
        .pipe(gulp.dest('./public/css'))
        .pipe(browserSync.stream({match: '**/*.css'}));
});

gulp.task('webpack', function() {
return gulp.src('./assets/js/app/app.js')
    .pipe(webpackStream( require('./webpack.config.js'), webpack ))
    .on('error', swallowError)
    .pipe(gulp.dest('./public/js'));
});

//compiles all jquery plugins and scripts into one file, but only works when gulp default is triggered
//have not figured out how to include in hot reload yet
gulp.task('scripts', function() {
  return gulp.src([
      './public/js/jquery/onload.js'
    ])
    .pipe(plumber())
    .pipe(concat('scripts.js'))
    .pipe(gulp.dest('./public/js/'));
});

gulp.task('production', function() {
    //Setting ENV to production so Webpack will minify JS files. 
    process.env.NODE_ENV = 'production';
    gulp.src('./assets/js/app/app.js')
        .pipe(webpackStream( require('./webpack.config.js'), webpack ))
        .pipe(gulp.dest('./public/js'));

    //gulp.src('./public/css/app.css')
        //.pipe(csso())
        //.pipe(gulp.dest('./public/css'));

    //the above code was mixing up the css once minified so using sass compiler and minifier instead
    gulp.src('./assets/scss/app/**/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(sass({        
       outputStyle: 'compressed'
    }))
    .pipe(gulp.dest('./public/css'));

    gulp.src('./public/css/vendor.css')
        .pipe(csso())
        .pipe(gulp.dest('./public/css'));
});


gulp.task('watch', function () {
    //Webpack will watch the asser files. All we need is to watch the compiled files.
    gulp.watch('./public/js/*.js').on('change', browserSync.reload);
    gulp.watch(['./assets/scss/app/**/*.scss', './assets/src/scss/app/components/*.scss'], ['sass']);
    gulp.watch(['./assets/scss/vendor/**/*.scss'], ['sass-vendor']);
});

gulp.task('sync', function() {
    var options = {
        //proxy: 'local.test',//for wp
        proxy: 'test/static.html',//for static
        files: [
            '**/*.php'
        ],
        ghostMode: {
            clicks: false,
            location: false,
            forms: false,
            scroll: false
        },
        injectChanges: true,
        logFileChanges: true,
        logLevel: 'debug',
        logPrefix: 'gulp-patterns',
        notify: true,
        reloadDelay: 0
    };
    browserSync(options);
});
  
gulp.task('default', ['scripts', 'webpack', 'sass', 'sass-vendor', 'watch', 'sync']);