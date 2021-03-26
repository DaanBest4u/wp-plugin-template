const webpack = require('webpack');
const path = require('path');
const NODE_ENV = process.env.NODE_ENV || 'development';
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const { WebpackManifestPlugin } = require('webpack-manifest-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');


module.exports = {
  mode: NODE_ENV,
  entry: {
    client: ['./assets/src/js/client.js', './assets/src/css/client.scss'],
    admin: ['./assets/src/js/admin.js', './assets/src/css/admin.scss']
  },
  output: {
    path: path.resolve(__dirname, 'assets/dist'),
    filename: './js/[name].[contenthash].js',
  },
  module: {
    rules: [
      {
        test: /.js?$/,
        use: [
          {
            loader: 'babel-loader',
            options: {
              presets: ['@babel/preset-env'],
              plugins: [
                '@babel/plugin-transform-async-to-generator',
                '@babel/plugin-proposal-object-rest-spread',
              ],
            },
          },
        ],
        exclude: /node_modules/,
      },
      {
        test: /\.(css|scss)$/,
        use: [
          {
            loader: MiniCssExtractPlugin.loader,
          },
          'css-loader',
          {
            loader: 'postcss-loader',
            options: {
              plugins: [require('autoprefixer')],
            },
          },
          'sass-loader',
        ],
      },
    ],
  },
  plugins: [
    new CleanWebpackPlugin(),
    new webpack.DefinePlugin({
      'process.env.NODE_ENV': JSON.stringify(NODE_ENV),
    }),
    new MiniCssExtractPlugin({
      filename: './css/[name].[contenthash].css',
    }),
    new WebpackManifestPlugin({fileName: 'manifest.json'})
  ],
};
