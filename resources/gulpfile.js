/**********************************************************************************
	- File Info -
		File name		: gulpfile.jpg
		Author(s)		: DAVINA Leong Shi Yun
		Date Created	: 19 Dec 2016

	- Contact Info -
		Email	: leong.shi.yun@gmail.com
		Mobile	: (+65) 9369 3752 [Singapore]

***********************************************************************************/
var gulp = require("gulp");
var clean_css = require("gulp-clean-css");
var concat = require("gulp-concat");
var sourcemaps = require("gulp-sourcemaps");
var uglify = require("gulp-uglify");
var plumber = require("gulp-plumber");
var rename = require("gulp-rename");
var del = require("del");

const NODE_PATH = "./node_modules/";
const VENDOR_PATH = "./vendor/";
const COLOUR_REPO_PATH = "./colour_repo/";

// === Main Tasks start ===
gulp.task("default", ["clean", "css", "js", "jsx"]);

gulp.task("watch", ["default"], function()
{
    gulp.watch(COLOUR_REPO_PATH + "src/css/**/*.css", ["css"]);
    gulp.watch(COLOUR_REPO_PATH + "src/js/**/*.js", ["js"]);
    gulp.watch(COLOUR_REPO_PATH + "src/jsx/**/*.jsx", ["jsx"]);
});

gulp.task("dev-default", ["clean", "css", "js", "dev-jsx"]);

gulp.task("dev-watch", ["dev-default"], function()
{
    gulp.watch(COLOUR_REPO_PATH + "src/css/**/*.css", ["css"]);
    gulp.watch(COLOUR_REPO_PATH + "src/js/**/*.js", ["js"]);
    gulp.watch(COLOUR_REPO_PATH + "src/jsx/**/*.jsx", ["dev-jsx"]);
});
// === Main Tasks end ===

// === Manage Vendor Resources start ===
gulp.task("copy-vendor", function()
{
	console.log("--- task: copy-vendor STARTED ---");
    // --- Twitter Bootstrap start ---
    gulp.src([
        NODE_PATH + "bootstrap/dist/css/bootstrap.min.css",
        NODE_PATH + "bootstrap/dist/css/bootstrap.min.css.map"
    ]).pipe(gulp.dest(VENDOR_PATH + "bootstrap/css"));
    gulp.src([
        NODE_PATH + "bootstrap/dist/fonts/**"
    ]).pipe(gulp.dest(VENDOR_PATH + "bootstrap/fonts"));
    gulp.src([
        NODE_PATH + "bootstrap/dist/js/bootstrap.min.js"
    ]).pipe(gulp.dest(VENDOR_PATH + "bootstrap/js"));
    console.log("Copied Bootstrap files.");
    // --- Twitter Bootstrap end ---


    // --- Font-Awesome start ---
    gulp.src([
        NODE_PATH + "font-awesome/css/**",
        "!" + NODE_PATH + "font-awesome/css/font-awesome.css"
    ]).pipe(gulp.dest(VENDOR_PATH + "font-awesome/css"));

    gulp.src([
        NODE_PATH + "font-awesome/fonts/**"
    ]).pipe(gulp.dest(VENDOR_PATH + "font-awesome/fonts"));
    console.log("Copied Font-Awesome files.");
    // --- Font-Awesome end ---


    // --- jQuery end ---
    gulp.src([
        NODE_PATH + "jquery/dist/jquery.min.js",
        NODE_PATH + "jquery/dist/jquery.min.map"
    ]).pipe(gulp.dest(VENDOR_PATH + "jquery"));
    console.log("Copied jQuery files.");
    // --- jQuery end ---

    // --- ParsleyJS end ---
    gulp.src([
        NODE_PATH + "parsleyjs/dist/parsley.min.js",
        NODE_PATH + "parsleyjs/dist/parsley.min.js.map"
    ]).pipe(gulp.dest(VENDOR_PATH + "parsleyjs"));
    console.log("Copied ParsleyJs files.");
    // --- ParsleyJS end ---
	console.log("--- task: copy-vendor ENDED ---");
});

gulp.task("clean-vendor", function()
{
    console.log("--- task: delete_vendor STARTED ---");

    del.sync([
        VENDOR_PATH + "bootstrap/**",
        VENDOR_PATH + "font-awesome/!**",
        VENDOR_PATH + "jquery/!**",
        VENDOR_PATH + "parsleyjs/!**",
    ]);

    console.log("--- task: delete_vendor ENDED ---");
});

gulp.task("update-vendor", ["clean-vendor", "copy-vendor"]);
// === Manage Vendor Resources end ===

// === Colour Repo Resources end ===
gulp.task("css", function()
{
    console.log("--- task: css STARTED ---");
    // --- All css but Debug, Login and Sign Up start ---
    gulp.src([
            COLOUR_REPO_PATH + "src/css/**.css",
            "!" + COLOUR_REPO_PATH + "src/css/cr_styles_login.css",
            "!" + COLOUR_REPO_PATH + "src/css/cr_styles_signup.css",
            "!" + COLOUR_REPO_PATH + "src/css/cr_styles_debug.css"
        ])
        .pipe(clean_css({compatibility: "ie8"}))
        .pipe(concat("cr_styles.min.css"))
        .pipe(gulp.dest(COLOUR_REPO_PATH + "dist/css"));
    console.log("Minified and Concatenated css ~");
    // --- All css but Debug, Login and Sign Up end ---

    // --- Signup start ---
    gulp.src(COLOUR_REPO_PATH + "src/css/cr_styles_signup.css")
        .pipe(clean_css({compatibility: "ie8"}))
        .pipe(rename({suffix: ".min"}))
        .pipe(gulp.dest(COLOUR_REPO_PATH + "dist/css"));
    console.log("Minified 'cr_styles_signup.css' ~");
    // --- Signup end ---

    // --- Login start ---
    gulp.src(COLOUR_REPO_PATH + "src/css/cr_styles_login.css")
        .pipe(clean_css({compatibility: "ie8"}))
        .pipe(rename({suffix: ".min"}))
        .pipe(gulp.dest(COLOUR_REPO_PATH + "dist/css"));
    console.log("Minified 'cr_styles_login.css' ~");
    // --- Login end ---

    // --- Debug start ---
    gulp.src(COLOUR_REPO_PATH + "src/css/cr_styles_debug.css")
        .pipe(clean_css({compatibility: "ie8"}))
        .pipe(rename({suffix: ".min"}))
        .pipe(gulp.dest(COLOUR_REPO_PATH + "dist/css"));
    console.log("Minified 'cr_styles_debug.css' ~");
    // --- Debug end ---
    console.log("--- task: css ENDED ---");
});

gulp.task("js", function(cb)
{
    console.log("--- task: js STARTED ---");
    // --- Clock start ---
    gulp.src(COLOUR_REPO_PATH + "src/js/**.js")
        .pipe(plumber({errorHandler:function(err) {
            console.log(err);
        }}))
        .pipe(uglify())
        .pipe(sourcemaps.write())
        .pipe(rename({suffix: ".min"}))
        .pipe(gulp.dest(COLOUR_REPO_PATH + "dist/js"));
    console.log("Uglified 'cr-clock.js.'");
    // -- Clock end ---
    console.log("--- task: js ENDED ---");
});

gulp.task("jsx", function()
{
    console.log("--- task: jsx STARTED ---");
    gulp.src(COLOUR_REPO_PATH + "src/jsx/**.jsx")
        .pipe(plumber({errorHandler:function(err) {
            console.log(err);
        }}))
        .pipe(babel({
            "presets":["es2015", "react"],
            "plugins":["syntax-object-rest-spread"]
        }))
        .pipe(uglify())
        .pipe(rename({
            suffix: ".min",
            extname: ".js"}))
        .pipe(gulp.dest(COLOUR_REPO_PATH + "dist/jsx/"));
    console.log("--- task: jsx ENDED ---");
});

gulp.task("dev-jsx", function()
{
    console.log("--- task: dev-jsx STARTED ---");
    gulp.src(COLOUR_REPO_PATH + "src/jsx/**.jsx")
        .pipe(sourcemaps.init())
        .pipe(plumber({errorHandler:function(err) {
            console.log(err);
        }}))
        .pipe(babel({
            "presets":["es2015", "react"],
            "plugins":["syntax-object-rest-spread"]
        }))
        .pipe(uglify())
        .pipe(sourcemaps.write())
        .pipe(rename({
            suffix: ".min",
            extname: ".js"}))
        .pipe(gulp.dest(COLOUR_REPO_PATH + "dist/jsx/"));
    console.log("--- task: dev-jsx ENDED ---");
});

gulp.task("clean", function()
{
    console.log("--- task: delete STARTED ---");

    del.sync([
        COLOUR_REPO_PATH + "dist/**",
        "!" + COLOUR_REPO_PATH + "dist"
    ]);

    console.log("--- task: delete ENDED ---");
});
// === Colour Repo Resources end ===