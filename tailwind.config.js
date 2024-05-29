/** @type {import('tailwindcss').Config} */
module.exports = {
  purge: [],
  darkMode: false, // ou 'media' ou 'class'
  theme: {
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
module.exports = {
  plugins: [require('@tailwindcss/forms'),]
};