const browserSync   = require('browser-sync').create();
const gulp          = require('gulp');
const autoprefixer  = require('autoprefixer');
const cleanCSS      = require('gulp-clean-css');
const postcss       = require('gulp-postcss');
const sass          = require('gulp-sass');
const sourcemaps    = require('gulp-sourcemaps');
const uglify        = require('gulp-uglify');

// Store all paths
const paths = {
    sass: './sass/**/*.scss',
    css: './css/',
    jsSrc: './js/src/*.js',
    jsDist: './js/dist/',
    php: './**/*.php'
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
        .pipe(cleanCSS({
            compatibility: {
                colors: {
                    opacity: true
                },
                units: {
                    rem: true,
                    vh: true,
                    vm: true,
                    vmax: true,
                    vmin: true
                }
            },
            level: 2
        }))
        .pipe(gulp.dest(paths.css));
}

/**
 * JavaScript Task
 *
 * Currently there is only one JavaScript task (no separated for dev and prod).
 * @return {object} Linted (auto fixable, warnings printed to console about
 * others) and minified JavaScript files.
 */
function scriptsTask() {
    return gulp
        .src(paths.jsSrc)
        .pipe(uglify())
        .pipe(gulp.dest(paths.jsDist))
        .pipe(browserSync.stream());
}

/**
 * PHP Task
 *
 * @return {object} Watched twig template files.
 */
function phpTask() {
    return gulp
        .src(paths.php)
        .pipe(browserSync.stream());
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
    gulp.watch(paths.php, phpTask);
    done();
}

// export tasks
exports.default = gulp.series(sassDevTask, scriptsTask, browserSyncTask);
exports.prod = sassProdTask; // NOT run it until not solve minify caused css issues!
exports.sassDev = sassDevTask;
exports.sassProd = sassProdTask; // NOT run it until not solve minify caused css issues!
exports.scripts = scriptsTask;
