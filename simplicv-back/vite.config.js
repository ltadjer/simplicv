// vite.config.js
const { createVuePlugin } = require('@vitejs/plugin-vue');

module.exports = {
  plugins: [
    createVuePlugin(),
  ],
  resolve: {
    alias: {
      '@': resolve(__dirname, 'assets'),
    },
  },
};
