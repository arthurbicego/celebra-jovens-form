/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*.{html,js,php}"],
  theme: {
    extend: {
      backgroundImage: { celebrabg: "url('./background-img.jpg')" },
      colors: {
        celebraverde: "#A6CE3A",
        celebraverdehover: "#91b432",
        celebraroxo: "#F1008E",
        celebraazul: "#3E55A3",
        celebraazulhover: "#414C70",
      },
    },
  },
  plugins: [],
};
