const path = require('path');
const glob = require('glob');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const TerserPlugin = require('terser-webpack-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const StylelintPlugin = require('stylelint-webpack-plugin');
const ESLintPlugin = require('eslint-webpack-plugin');
const WatchExternalFilesPlugin = require('webpack-watch-external-files-plugin');

const EXTERNALS = {
  swiper: 'Swiper',
  choices: 'Choices',
  datatable: 'DataTable',
  jquery: 'jQuery',
  isotope: 'Isotope',
  '@global/constants': 'wpGlobalConstants',
};

const ALIASES = {
  '@shared': path.resolve(__dirname, 'src/shared'),
  '@services': path.resolve(__dirname, 'src/shared/services'),
};

module.exports = () => {
  const entries = glob.sync(`${process.env.UNIX_ENTRY_PATH}/*.{js,scss}`);
  const name = path.basename(process.env.UNIX_ENTRY_PATH);
  const isProduction = process.env.MODE === 'production';
  const isWatching = process.env.WATCH === 'true';

  const IGNORE_OUTPUT_PARTS = ['src'];

  const rawEntryParts = path.normalize(process.env.ENTRY).split(path.sep);
  const entryParts = rawEntryParts.filter((part) => !IGNORE_OUTPUT_PARTS.includes(part));

  const entryKey = `${entryParts.join('/')}/${name}`;

  const watchModePlugins = [
    new WatchExternalFilesPlugin({
      files: [`/${process.env.UNIX_ENTRY_PATH}/**/*.php`],
    }),
  ];

  return {
    entry: () => {
      return {
        [entryKey]: entries.map((entry) => path.resolve(__dirname, entry)),
      };
    },
    mode: process.env.MODE,
    stats: 'minimal',
    output: {
      filename: '[name].js?[fullhash]',
      path: path.resolve(__dirname, 'public'),
      assetModuleFilename: '../[file]',
    },
    watch: isWatching,
    watchOptions: {
      aggregateTimeout: 200,
      poll: 1000,
      ignored: /node_modules/,
    },
    plugins: [
      ...(isWatching ? watchModePlugins : []),
      require('autoprefixer'),
      new StylelintPlugin({
        fix: true,
        files: [path.resolve(process.env.UNIX_ENTRY_PATH, '**/*.scss')],
      }),
      new ESLintPlugin({
        files: [path.resolve(process.env.UNIX_ENTRY_PATH, '**/*.js')],
      }),
      new MiniCssExtractPlugin({
        filename: '[name].css?[fullhash]',
      }),
    ],
    optimization: {
      minimize: isProduction,
      minimizer: [new TerserPlugin(), new CssMinimizerPlugin()],
    },
    module: {
      rules: [
        {
          test: /\.(js|jsx)$/i,
          loader: 'babel-loader',
        },
        {
          test: /\.s[ac]ss$/i,
          use: [MiniCssExtractPlugin.loader, 'css-loader', 'postcss-loader', 'sass-loader'],
        },
        {
          test: /\.css$/i,
          use: [MiniCssExtractPlugin.loader, 'css-loader', 'postcss-loader'],
        },
        {
          test: /\.(eot|svg|ttf|woff|woff2|png|jpg|gif)$/i,
          type: 'asset/resource',
          generator: {
            emit: false,
          },
        },
        {
          test: /\.html$/i,
          loader: 'html-loader',
        },
      ],
    },
    externals: EXTERNALS,
    resolve: {
      alias: ALIASES,
    },
  };
};
