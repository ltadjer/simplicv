const Encore = require('@symfony/webpack-encore');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const path = require('path');
const autoprefixer = require('autoprefixer');
const tailwindcss = require('tailwindcss');
const { VueLoaderPlugin } = require('vue-loader');
const tailwindConfig = require('./tailwind.config.js');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');

if (!Encore.isRuntimeEnvironmentConfigured()) {
  Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore.setOutputPath('public/build/')
  .setPublicPath('/build')
  .addEntry('app', './assets/app.js')
  .addStyleEntry('admin', './assets/styles/admin.css')
  .enableVueLoader()
  .configureBabelPresetEnv((config) => {
    config.useBuiltIns = 'usage';
    config.corejs = '3.23';
  })
  .enableSassLoader()
  .cleanupOutputBeforeBuild()
  .enableBuildNotifications()
  .enableSourceMaps(!Encore.isProduction())
  .enableVersioning(Encore.isProduction())
  .configureDevServerOptions(options => {
        // Activer HTTPS en environnement de développement
        options.https(true);
    })
  .addPlugin(new HtmlWebpackPlugin({
    template: './assets/index.html',
    filename: 'index.html',
    inject: true,
  }))
  .enablePostCssLoader((options) => {
    options.postcssOptions = {
      plugins: [
        tailwindcss,
        autoprefixer,
      ],
    };
  })
  .addPlugin(new CleanWebpackPlugin())
  .enableSingleRuntimeChunk()
  .configureBabel(() => {}, {
    useBuiltIns: 'usage',
    corejs: 3,
  });

module.exports = Encore.getWebpackConfig();
