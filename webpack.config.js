const {VueLoaderPlugin} = require('vue-loader');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const autoprefixer = require("autoprefixer");

module.exports = (env) => ({
  devServer: {
    proxy: [{
      context: ['/'],
      target: 'http://localhost:8000',
      pathRewrite: { '^/': '' },
      changeOrigin: true,
      secure: false
    },],
    historyApiFallback: true,
    hot: true,
    open: true
  },
  mode: 'development',
  entry: './src/js/app.js',
  output: {
    filename: 'main.[contenthash].js',
    publicPath: '/',
  },
  module: {
    rules: [
      {
        test: /\.(?:js)$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: [
              ['@babel/preset-env', { targets: "defaults" }]
            ]
          }
        }
      },
      {
        test: /\.vue$/,
        loader: "vue-loader",
      },
      {
        test: /\.(png|jpg|jpeg|gif|ttf)$/i,
        type: 'asset/resource',
      },
      {
        test: /\.(scss)$/,
        use: [
          {
            // Adds CSS to the DOM by injecting a `<style>` tag
            loader: env.prod ? MiniCssExtractPlugin.loader : "style-loader",
          },
          {
            // Interprets `@import` and `url()` like `import/require()` and will resolve them
            loader: 'css-loader'
          },
          {
            // Loader for webpack to process CSS with PostCSS
            loader: 'postcss-loader',
            options: {
              postcssOptions: {
                plugins: [
                  autoprefixer
                ]
              }
            }
          },
          {
            // Loads a SASS/SCSS file and compiles it to CSS
            loader: 'sass-loader'
          }
        ]
      },
      {
        test: /\.css$/i,
        use: [
          env.prod ? MiniCssExtractPlugin.loader : "style-loader",
          "css-loader",
        ],
      }
    ]
  },
  plugins: [
    new VueLoaderPlugin(),
    new HtmlWebpackPlugin({
      title: 'Todo-list',
      template: "./src/index.html"
    }),
    new MiniCssExtractPlugin({
      filename: 'main.[contenthash].css',
    }),
  ],
  optimization: {

  },
})
