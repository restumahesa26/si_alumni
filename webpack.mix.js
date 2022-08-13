// const mix = require('laravel-mix');

// /*
//  |--------------------------------------------------------------------------
//  | Mix Asset Management
//  |--------------------------------------------------------------------------
//  |
//  | Mix provides a clean, fluent API for defining some Webpack build steps
//  | for your Laravel applications. By default, we are compiling the CSS
//  | file for the application as well as bundling up all the JS files.
//  |
//  */

// mix.js('resources/js/app.js', 'public/js').postCss('resources/css/app.css', 'public/css', [
//     require('postcss-import'),
//     require('tailwindcss'),
//     require('autoprefixer'),
// ]);
rules.push({
    // only include svg that doesn't have font in the path or file name by using negative lookahead
    test: /(\.(png|jpe?g|gif|webp)$|^((?!font).)*\.svg$)/,
    loaders: [
        {
            loader: 'file-loader',
            options: {
                name: path => {
                    if (!/node_modules|bower_components/.test(path)) {
                        return (
                            Config.fileLoaderDirs.images +
                            '/[name].[ext]?[hash]'
                        );
                    }

                    return (
                        Config.fileLoaderDirs.images +
                        '/' +       //<---------------------  Remove vendor from image path
                        path
                            .replace(/\\/g, '/')
                            .replace(
                                /((.*(node_modules|bower_components))|images|image|img|assets)\//g,
                                ''
                            ) +
                        '?[hash]'
                    );
                },
                publicPath: Config.resourceRoot
            }
        },

        {
            loader: 'img-loader',
            options: Config.imgLoaderOptions
        }
    ]
});

// Add support for loading fonts.
rules.push({
    test: /(\.(woff2?|ttf|eot|otf)$|font.*\.svg$)/,
    loader: 'file-loader',
    options: {
        name: path => {
            if (!/node_modules|bower_components/.test(path)) {
                return Config.fileLoaderDirs.fonts + '/[name].[ext]?[hash]';
            }

            return (
                Config.fileLoaderDirs.fonts +
                '/' +       //<------------------------- Remove vendo from font path
                path
                    .replace(/\\/g, '/')
                    .replace(
                        /((.*(node_modules|bower_components))|fonts|font|assets)\//g,
                        ''
                    ) +
                '?[hash]'
            );
        },
        publicPath: Config.resourceRoot
    }
});
