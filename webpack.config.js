import path from "path";
import { fileURLToPath } from "url";
import MiniCssExtractPlugin from "mini-css-extract-plugin";

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

export default {
  mode: "production",
  entry: {
    "./src/assets/admin/js/admin": "./src/assets/admin/js/admin.js",
    // "./src/assets/public/js/main": "./src/assets/public/js/main.js",
  },
  output: {
    path: __dirname, // Use current directory to keep files in place
    filename: "[name].min.js",
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: "babel-loader",
          options: {
            presets: ["@babel/preset-env"],
          },
        },
      },
      {
        test: /\.scss$/,
        use: [MiniCssExtractPlugin.loader, "css-loader", "sass-loader"],
      },
    ],
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: ({ chunk }) => {
        return chunk.name.replace("js", "scss") + ".min.css";
      },
    }),
  ],
};
