/** @type {import('tailwindcss').Config} */
module.exports = {
  content: require("fast-glob").sync([
    "./template-parts/**/*.php",
    "./**/*.php",
    "./*.php",
    "./***/**/*.php",
  ]),
  theme: {
    extend: {
      fontWeight: {
        medium: 500,
      },
      colors: {
        primary: "#cb403c",
        secondary: "#646464",
      },
    },
  },
  plugins: [],
};
