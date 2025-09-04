export default {
  content: [
    './Views/**/*.php',
    './views/**/*.php',
    './Views/layouts/**/*.php',
    './views/layouts/**/*.php',
    './Controllers/**/*.php',
    './controllers/**/*.php',
    './index.php',
    './public/**/*.js',
    './node_modules/preline/dist/*.js',
    './node_modules/@preline/datepicker/**/*.js',
  ],
  theme: {
    extend: {}
  },
  plugins: [
    require('preline/plugin'),
    require('@preline/datepicker/plugin'),
  ]
}
