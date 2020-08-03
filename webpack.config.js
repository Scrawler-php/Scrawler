const path = require('path')
const VueLoaderPlugin = require('vue-loader/lib/plugin')

module.exports = {
  entry: './app/views/vue/main.ts',
  output: {
    path: path.resolve(__dirname, "./assets/js"),
    filename: 'app.js'
  },
  devServer: {
    contentBase: path.resolve(__dirname, 'public')
  },
  module: {
    rules: [
     {
       test: /\.vue$/,
       loader: "vue-loader"
     },
     {
       test: /\.(scss|css)$/,
       use: ["vue-style-loader", "css-loader"]
     },
     {
       test: /\.js$/,
       loader: "babel-loader",
       exclude: /node_modules/
     },
     {
        test: /\.ts$/,
        exclude: /node_modules|vue\/src/,
        loader: "ts-loader",
        options: {
          appendTsSuffixTo: [/\.vue$/]
        }
      },
    ]
   },
   resolve: {
    alias: {
     vue$: "vue/dist/vue.esm.js"
    },
    extensions: ['.ts',"*", ".js", ".vue", ".json"]
   },
   plugins: [new VueLoaderPlugin()],
 }
