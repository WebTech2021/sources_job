const mix = require('laravel-mix')
const path = require('path')

// job-seeker dashboard styles
let styles = [
    "public/admin/app-assets/vendors/css/vendors.min.css",
    "public/admin/app-assets/vendors/css/forms/select/select2.min.css",
    "public/admin/app-assets/css/bootstrap.css",
    "public/admin/app-assets/css/bootstrap-extended.css",
    "public/admin/app-assets/css/bootstrap-extended.min.css",
    "public/admin/app-assets/css/colors.css",
    "public/admin/app-assets/css/components.css",
    "public/admin/app-assets/css/themes/dark-layout.css",
    "public/admin/app-assets/css/themes/semi-dark-layout.css",
    "public/admin/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css",
    "public/admin/app-assets/css/core/menu/menu-types/vertical-menu.css",
    "public/admin/assets/css/style.css",
    "public/admin/app-assets/vendors/css/extensions/toastr.min.css",
    "public/admin/app-assets/css/pages/app-email.css",
    "public/admin/app-assets/css/plugins/extensions/ext-component-toastr.css",
    "public/admin/app-assets/css/themes/bordered-layout.css",
]
// job_seeker dashboard scripts
let scripts = [
    "public/admin/app-assets/vendors/js/vendors.min.js",
    "public/admin/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js",
    "public/admin/app-assets/js/core/app-menu.js",
    "public/admin/app-assets/js/core/app.js",
    "public/admin/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js",
    "public/admin/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js",
    "public/admin/app-assets/vendors/js/forms/select/select2.full.min.js",
    "public/admin/app-assets/vendors/js/extensions/toastr.min.js",
    "public/admin/app-assets/vendors/js/forms/select/select2.full.min.js",
    "public/admin/app-assets/js/scripts/pages/app-email.js",
]

mix.styles(styles, 'public/css/jobseeker.css')
    .babel(scripts, 'public/js/jobseeker.js')

mix
    .js('resources/js/app.js', 'public/js')
    .webpackConfig({
        resolve: {
            alias: {
                '@': path.resolve(__dirname, 'resources/js/src/'),
                '@themeConfig': path.resolve(__dirname, 'resources/js/themeConfig.js'),
                '@core': path.resolve(__dirname, 'resources/js/src/@core'),
                '@validations': path.resolve(__dirname, 'resources/js/src/@core/utils/validations/validations.js'),
                '@axios': path.resolve(__dirname, 'resources/js/src/libs/axios')
            }
        },
        module: {
            rules: [
                {
                    test: /\.s[ac]ss$/i,
                    use: [
                        {
                            loader: 'sass-loader',
                            options: {
                                sassOptions: {
                                    includePaths: ['node_modules', 'resources/js/src/assets']
                                }
                            }
                        }
                    ]
                },
                {
                    test: /(\.(png|jpe?g|gif|webp)$|^((?!font).)*\.svg$)/,
                    loaders: {
                        loader: 'file-loader',
                        options: {
                            name: 'images/[path][name].[ext]',
                            context: '../vuexy-vuejs-bootstrap-vue-template/src/assets/images'
                        }
                    }
                }
            ]
        },
        output: {
            chunkFilename: mix.inProduction() ? "js/chunks/[chunkhash].js" : "js/chunks/[name].[chunkhash].js"
        },
        devtool: mix.inProduction() ? false : 'source-map'
    })
    .sass('resources/scss/app.scss', 'public/css')
    .options({
        postCss: [require('autoprefixer'), require('postcss-rtl')]
    })
mix.copy('resources/scss/loader.css', 'public/css')

mix.sourceMaps(false)
mix.version()






// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css')
//     .sourceMaps();
