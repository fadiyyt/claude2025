const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const TerserPlugin = require('terser-webpack-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');

const isProduction = process.env.NODE_ENV === 'production';

module.exports = {
  mode: isProduction ? 'production' : 'development',
  
  entry: {
    main: './src/js/main.js',
    styles: './src/scss/main.scss'
  },
  
  output: {
    path: path.resolve(__dirname, 'dist'),
    filename: 'js/[name].min.js',
    publicPath: '/wp-content/themes/practical-solutions-pro/dist/',
    clean: true
  },
  
  devtool: isProduction ? 'source-map' : 'eval-source-map',
  
  module: {
    rules: [
      // JavaScript
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: [
              ['@babel/preset-env', {
                targets: {
                  browsers: ['> 1%', 'last 2 versions']
                }
              }]
            ]
          }
        }
      },
      
      // SCSS/CSS
      {
        test: /\.(scss|sass|css)$/,
        use: [
          MiniCssExtractPlugin.loader,
          {
            loader: 'css-loader',
            options: {
              sourceMap: !isProduction,
              importLoaders: 2
            }
          },
          {
            loader: 'postcss-loader',
            options: {
              sourceMap: !isProduction,
              postcssOptions: {
                plugins: [
                  ['autoprefixer', {
                    overrideBrowserslist: ['> 1%', 'last 2 versions']
                  }],
                  ['rtlcss', {
                    // تحويل تلقائي للـ RTL
                    autoRename: false,
                    stringMap: [
                      {
                        name: 'left-right',
                        priority: 100,
                        search: ['left', 'Left', 'LEFT'],
                        replace: ['right', 'Right', 'RIGHT'],
                        options: {
                          scope: '*',
                          ignoreCase: false
                        }
                      }
                    ]
                  }]
                ]
              }
            }
          },
          {
            loader: 'sass-loader',
            options: {
              sourceMap: !isProduction,
              sassOptions: {
                outputStyle: isProduction ? 'compressed' : 'expanded',
                includePaths: [
                  path.resolve(__dirname, 'src/scss'),
                  path.resolve(__dirname, 'node_modules')
                ]
              }
            }
          }
        ]
      },
      
      // الصور والخطوط
      {
        test: /\.(png|jpg|jpeg|gif|svg|webp)$/i,
        type: 'asset/resource',
        generator: {
          filename: 'images/[name].[hash:8][ext]'
        },
        parser: {
          dataUrlCondition: {
            maxSize: 8 * 1024 // 8kb
          }
        }
      },
      
      {
        test: /\.(woff|woff2|eot|ttf|otf)$/i,
        type: 'asset/resource',
        generator: {
          filename: 'fonts/[name].[hash:8][ext]'
        }
      }
    ]
  },
  
  plugins: [
    // تنظيف مجلد الإخراج
    new CleanWebpackPlugin(),
    
    // استخراج CSS إلى ملفات منفصلة
    new MiniCssExtractPlugin({
      filename: 'css/[name].min.css',
      chunkFilename: 'css/[id].min.css'
    })
  ],
  
  optimization: {
    minimize: isProduction,
    minimizer: [
      // ضغط JavaScript
      new TerserPlugin({
        terserOptions: {
          format: {
            comments: false
          },
          compress: {
            drop_console: isProduction,
            drop_debugger: isProduction
          }
        },
        extractComments: false
      }),
      
      // ضغط CSS
      new CssMinimizerPlugin({
        minimizerOptions: {
          preset: [
            'default',
            {
              discardComments: { removeAll: true }
            }
          ]
        }
      })
    ],
    
    // تقسيم الكود
    splitChunks: {
      chunks: 'all',
      cacheGroups: {
        vendor: {
          test: /[\\/]node_modules[\\/]/,
          name: 'vendors',
          priority: 10,
          enforce: true
        },
        common: {
          name: 'common',
          minChunks: 2,
          priority: 5,
          reuseExistingChunk: true
        }
      }
    }
  },
  
  resolve: {
    extensions: ['.js', '.jsx', '.scss', '.css'],
    alias: {
      '@': path.resolve(__dirname, 'src'),
      '@scss': path.resolve(__dirname, 'src/scss'),
      '@js': path.resolve(__dirname, 'src/js'),
      '@images': path.resolve(__dirname, 'src/images')
    }
  },
  
  // إعدادات خادم التطوير
  devServer: {
    static: {
      directory: path.join(__dirname, 'dist')
    },
    port: 3000,
    hot: true,
    open: true,
    compress: true,
    historyApiFallback: true,
    proxy: {
      '/wp-admin': 'http://localhost:8080',
      '/wp-json': 'http://localhost:8080'
    }
  },
  
  // إعدادات الأداء
  performance: {
    hints: isProduction ? 'warning' : false,
    maxEntrypointSize: 512000,
    maxAssetSize: 512000
  },
  
  // إعدادات المراقبة
  watchOptions: {
    ignored: /node_modules/,
    poll: 1000
  },
  
  // إحصائيات البناء
  stats: {
    colors: true,
    modules: false,
    children: false,
    chunks: false,
    chunkModules: false
  }
};