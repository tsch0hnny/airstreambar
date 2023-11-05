/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/**/*.{html,js,php}", "./dist/**/*.{html,js,php}"],
  theme: {
    extend: {
      boxShadow: {
        'cstm': '0px 5px 14px 3px #0000004a',
        'cstm-lighter': '0px 5px 14px 3px rgb(0 0 0 / 18%)'
      }
    },
    fontFamily: {
      'sans': '"Work Sans"',
      'serif': '"Playfair Display"',
    }
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('autoprefixer'),
  ],
}

