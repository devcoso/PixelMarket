/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./views/**/*.php", "./public/js/**/*.js", "./classes/Paginacion.php"],
  theme: {
    extend: {},
    fontFamily: {
      'sans': ['Lato', 'sans-serif'],
      'display': ['Tiny5'],
    },
  },
  plugins: [],
}

