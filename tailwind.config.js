const { initFlowbite } = require("flowbite");

module.exports = {
  content: [
    "./src/**/*.{html,js}",
    "./node_modules/flowbite/**/*.js", // Include Flowbite components
  ],

  theme: {
    extend: {
      container: {
        center: true,
        padding: "1rem",
      },
    },
  },
  plugins: [Flowbite],
};
