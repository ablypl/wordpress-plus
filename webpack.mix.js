const { mix } = require('laravel-mix');


const defaults = {
    resources: {
        base: "resources/assets/",
        js: 'resources/assets/js/',
        sass: 'resources/assets/sass/'
    },
    public: 'theme/assets/'
};

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */
mix.setPublicPath(defaults.public);
// mix.setResourceRoot(defaults.resources.base);
// mix.js('src/app.js', 'dist/')
    
   mix.sass(defaults.resources.sass + 'style.sass', 'css/style.css')
    .js(defaults.resources.js + 'app.js', 'js/app.js');

// Full API
// mix.js(src, output);
// mix.extract(vendorLibs);
// mix.sass(src, output);
// mix.less(src, output);
// mix.combine(files, destination);
// mix.copy(from, to);
// mix.minify(file);
// mix.sourceMaps(); // Enable sourcemaps
// mix.version(); // Enable versioning.
// mix.disableNotifications();
// mix.setPublicPath('path/to/public'); <-- Useful for Node apps.
// mix.webpackConfig({}); <-- Override webpack.config.js, without editing the file directly.
