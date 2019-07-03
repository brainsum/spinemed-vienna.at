const browserSync   = require('browser-sync').create();
const gulp          = require('gulp');
const autoprefixer  = require('autoprefixer');
const purge         = require('gulp-css-purge');
const postcss       = require('gulp-postcss');
const sass          = require('gulp-sass');
const sourcemaps    = require('gulp-sourcemaps');

// Store all paths
const paths = {
    sass: './sass/**/*.scss',
    css: './css/'
};

/**
 * SASS:Development Task
 *
 * Sass task for development with live injecting into all browsers
 * @return {object} Autoprefixed CSS files with expanded style and sourcemaps.
 */
function sassDevTask() {
    return gulp
        .src(paths.sass)
        .pipe(sourcemaps.init({ largeFile: true }))
        .pipe(sass({ outputStyle: 'expanded', precision: 10 }))
        .on('error', sass.logError)
        .pipe(postcss([autoprefixer()]))
        .pipe(sourcemaps.write({ includeContent: false }))
        .pipe(sourcemaps.init({ loadMaps: true }))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest(paths.css))
        .pipe(browserSync.stream());
}

/**
 * SASS:Production Task
 *
 * Sass task for production with linting, to be stored in Git (run before
 * commit)
 * @return {object} Autoprefixed, minified, ordered and linted* CSS files without
 * sourcemaps.
 */
function sassProdTask() {
    return gulp
        .src(paths.sass)
        .pipe(sass({ outputStyle: 'compact', precision: 10 }))
        .on('error', sass.logError)
        .pipe(postcss([autoprefixer()]))
        .pipe(
            purge({
                trim: true,
                shorten: true,
                verbose: true,
            }),
        )
        .pipe(gulp.dest(paths.css));
}

/**
 * BrowserSync Task
 *
 * Watching Sass and JavaScript source files for changes.
 * @prop {string} proxy Change it for your local setup.
 * @param {function} done Changed event.
 */
function browserSyncTask(done) {
    browserSync.init({
        proxy: 'spinemed.test',
        open: false,
        browser: [
            'Google Chrome',
        ],
    });
    gulp.watch(paths.sass, sassDevTask);
    done();
}

// export tasks
exports.default = gulp.series(sassDevTask, browserSyncTask);
exports.prod = sassProdTask;
exports.sassDev = sassDevTask;
exports.sassProd = sassProdTask;
