/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        theme: {
          bg: 'var(--theme-bg)',
          text: 'var(--theme-text)',
          primary: 'var(--theme-primary)',
          accent: 'var(--theme-accent)',
          card: 'rgba(var(--theme-card-rgb), <alpha-value>)',
        }
      }
    },
  },
  plugins: [],
}
