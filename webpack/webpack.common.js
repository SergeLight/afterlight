const helper = require('./rooth_path');
const path_js_dir = helper.root("resources/js");
const path_css_dir = helper.root("resources/css");
const miniCssPlugin = require("mini-css-extract-plugin");
const FixStyleOnlyEntriesPlugin = require("webpack-fix-style-only-entries");
const webpack = require('webpack');

module.exports = {
    entry: {
        authentication: path_js_dir+"/authentication.js",
        app_css: path_css_dir+"/app.sass"
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/
            },
            {
                test: /\.s[ac]ss$|css$/,
                use:  [
                    miniCssPlugin.loader,
                    {
                        loader: "css-loader",
                        options: {
                            url: false,
                            importLoaders: 1
                        }
                    },
                    {
                        loader: "sass-loader",
                    }
                ]
            },
        ]
    },
    plugins: [
        new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery',
        }),
        new FixStyleOnlyEntriesPlugin()
    ]
};
