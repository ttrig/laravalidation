const mix = require('laravel-mix')

require('laravel-mix-purgecss');

mix.webpackConfig({
  resolve: {
    alias: {
      '@': path.resolve(__dirname, 'resources/js/'),
    }
  }
})

mix.js('resources/js/app.js', 'public/js')
  .sass('resources/sass/app.scss', 'public/css')
  .purgeCss()


if (mix.inProduction()) {
  mix.version()
} else {
  mix.sourceMaps()
}

mix.browserSync({
  proxy: 'localhost:8000',
})
