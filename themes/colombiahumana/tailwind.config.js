/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.php",
    "./**/*.php",
    "./templates/**/*.php",
    "./template-parts/**/*.php",
    "./parts/**/*.php",
    "./inc/**/*.php",
    "./js/**/*.js"
  ],
  safelist: [
    'bg-black',
    'hover:bg-gray-800',
    'hover:text-gray-300',
    {
      pattern: /^(bg|text|hover|grid|flex|space|w|h|min-h|p|px|py|m|mx|my|gap|grid-cols|items|justify)-/,
      variants: ['hover', 'focus', 'sm', 'md', 'lg']
    }
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
