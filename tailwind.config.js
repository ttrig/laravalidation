module.exports = {
  purge: {
    content: [
      './resources/**/*.blade.php',
      './resources/**/*.js',
      './resources/**/*.vue',
    ],
  },
  darkMode: false,
  theme: {
    extend: {
      colors: {
        laravel: '#ff2d20',
      },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
