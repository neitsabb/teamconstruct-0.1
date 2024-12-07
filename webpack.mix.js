let mix = require("laravel-mix");

const THEME_DIR = "./wp-content/themes/teamconstruct-0.1";

mix
  .js("src/js/app.js", "assets/js") // Ajustez le chemin selon votre structure
  .postCss("src/css/app.css", "assets/css", [
    require("tailwindcss"),
    require("autoprefixer"),
  ]);

mix.browserSync({
  proxy: "http://teamconstruct.local/",
  files: [
    `${THEME_DIR}/*.php`,
    `${THEME_DIR}/**/*.php`,
    `${THEME_DIR}/assets/**/*.*`,
  ],
});
