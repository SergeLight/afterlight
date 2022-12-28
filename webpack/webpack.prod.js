const {merge} = require('webpack-merge');
const helper = require('./rooth_path');
const miniCssPlugin = require("mini-css-extract-plugin");
const commonConfig = require('./webpack.common');
const {WebpackManifestPlugin} = require("webpack-manifest-plugin");
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");
const TerserPlugin = require('terser-webpack-plugin')

module.exports = merge(commonConfig, {

    mode: 'production',

    output: {
        path: helper.root("public/prod"),
        filename: "[name]-[contenthash:10].js",
        clean: true,
        publicPath: ''
    },

    optimization: {
        minimizer: [
            new CssMinimizerPlugin({}),
            new TerserPlugin()
        ]
    },
    plugins: [

        new miniCssPlugin({
            filename: "[name]-[contenthash:10].css"
        }),
        new WebpackManifestPlugin({
            fileName:  helper.root("/resources/build-manifest/build-manifest.json")
        }),
    ]
});
