const {merge} = require('webpack-merge');
const helper = require('./rooth_path');
const miniCssPlugin = require("mini-css-extract-plugin");
const commonConfig = require('./webpack.common');
// const BundleAnalyzerPlugin = require("webpack-bundle-analyzer").BundleAnalyzerPlugin;


module.exports = merge(commonConfig, {

    mode: 'development',

    output: {
        path: helper.root("public/dev"),
        filename: "[name].js"
    },
    plugins: [

        new miniCssPlugin({
            filename: "[name].css"
        })
        // Turn on to Visualize packages : https://github.com/webpack-contrib/webpack-bundle-analyzer
        // ,new BundleAnalyzerPlugin()
    ]
});
