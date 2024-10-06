/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./views/**/*.php",
    "./views/*.php",
  ],
  theme: {
    extend: {
      colors: {
        'black-v1': '#1b1c1e'
      }
    },
  },
  plugins: [
    require('daisyui'),
  ],
}

