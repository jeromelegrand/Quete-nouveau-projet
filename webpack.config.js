let Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('web/build/')
    .setPublicPath('/web')
    .addEntry('style', './assets/scss/style.scss')
    .addEntry('main', './assets/js/main.js')
    .addEntry('homepage', './assets/js/homepage.js')
    .createSharedEntry('vendor', [
        'jquery',
    ])
    .autoProvidejQuery()
    .enableSourceMaps(!Encore.isProduction())
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSassLoader()
;

module.exports = Encore.getWebpackConfig();