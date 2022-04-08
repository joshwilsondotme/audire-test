var gulp = require('gulp');
var sass = require('gulp-sass');
var sassGlob = require('gulp-sass-glob');
var browserSync = require('browser-sync').create();
var postcss      = require('gulp-postcss');
var autoprefixer = require('autoprefixer');
var cssvariables = require('postcss-css-variables'); 
var calc = require('postcss-calc');  
var concat = require('gulp-concat');
var eslint = require('gulp-eslint');
var stripDebug = require('gulp-strip-debug');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');
var browsers = require('./package.json');

// js file paths
var utilJsPath = 'src/assets/js/*.js'; // util.js path - you may need to update this if including the framework as external node module
var scriptsJsPath = 'dist/assets/js'; //folder for final scripts.js/scripts.min.js files

// css file paths
var cssFolder = 'dist/assets/css'; // folder for final style.css/style-custom-prop-fallbac.css files
var scssFilesPath = 'src/assets/css/**/*.scss'; // scss files to watch

function reload(done) {
  browserSync.reload();
  done();
} 

gulp.task('sass', function() {
  return gulp.src(scssFilesPath)
  .pipe(sassGlob())
  .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
  .pipe(
    postcss([
      autoprefixer({ grid: 'autoplace', overrideBrowserslist: browsers.browserslist, remove: false }),
      cssvariables({ preserve: true }),
      calc(),
    ])
  )
  .pipe(gulp.dest(cssFolder))
  .pipe(browserSync.reload({
    stream: true
  }))
  .pipe(rename('style-fallback.css'))
  .pipe(postcss([cssvariables(), calc()]))
  .pipe(gulp.dest(cssFolder));
});


gulp.task('lint', function () {
  return gulp.src([utilJsPath, 'gulpfile.js'])
    .pipe(eslint())
    .pipe(eslint.format())
    .pipe(notify({ message: 'JS Hinting task complete' }));
})

gulp.task('scripts', function() {
  return gulp.src([utilJsPath])
  // .pipe(concat('scripts.js'))
  .pipe(browserSync.reload({
    stream: true
  }))
  // .pipe(uglify())
  .pipe(gulp.dest(scriptsJsPath))
  .pipe(browserSync.reload({
    stream: true
  }));
});

gulp.task('browserSync', gulp.series(function (done) {
  browserSync.init({
    notify: false,
    open: 'local',
    proxy: {
      target: 'http://admultisite.local/',
      ws: true
    },
    ghostMode: true,
    https: false,
    watchOptions: {
      debounceDelay: 1000
    },
    // browser: ['google chrome']
  })
  done();
}));

gulp.task('watch', gulp.series(['browserSync', 'sass', 'scripts'], function () {
  gulp.watch('**/*.php', gulp.series(reload));
  
  gulp.watch(scssFilesPath, gulp.series(['sass']));
  gulp.watch(utilJsPath, gulp.series(['scripts']));
}));
