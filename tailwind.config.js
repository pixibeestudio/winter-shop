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
        brand: {
          dark: '#3A5A40',   // Xanh rêu đậm (Button/Text)
          DEFAULT: '#588157', // Xanh lá chủ đạo
          light: '#A3B18A',  // Xanh nhạt
          bg: '#DAD7CD',     // Màu nền kem
          mint: '#C1E1C1',   // Màu nền tròn sau lưng áo
        }
      },
      fontFamily: {
        sans: ['Inter', 'sans-serif'],
      }
    },
  },
  plugins: [],
}