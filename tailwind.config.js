/** @type {import('tailwindcss').Config} */
export default {
  purge: false,
  content: [
    "./resources/views/**/*.blade.php",
    "./resources/views/components/**/*.blade.php",
  ],
  theme: {
    extend: {
      fontFamily: {
        sans:
          "'Fira Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen-Sans, Ubuntu, Cantarell, 'Helvetica Neue', Helvetica, Arial,sans-serif",
      },
      backgroundImage: (theme) => ({
        "gradient-ligh": "linear-gradient(45deg, #4f4141, #607264);",
        "gradient-light": "linear-gradient(45deg, #D1C9E0, #607264);",
        "gradient-dark": "linear-gradient(230deg, #374d41, #4f4141);",
        "gradient-danger": "linear-gradient(179deg, #d34756, #f3445b);",
      }),
      colors: {
        vns: {
          default: "#f5f7ff",
          lead: "rgb(113 115 167)",
          action: "#9E9FBF",
          "action-alt": "rgb(103 104 127)",
          error: "#d43246",
          danger: "rgb(255 220 220)",
        },
      },
    },
  },
  plugins: [],
};
