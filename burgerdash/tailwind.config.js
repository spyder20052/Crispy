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
        primary: {
          50: '#FFF5F5',
          100: '#FFE5E5',
          200: '#FFCCCC',
          300: '#FF9999',
          400: '#FF6666',
          500: '#FF0000',
          600: '#E60000',
          700: '#CC0000',
          800: '#990000',
          900: '#660000'
        },
        secondary: {
          50: '#FFFCF0',
          100: '#FFF8E0',
          200: '#FFF1C2',
          300: '#FFE999',
          400: '#FFE070',
          500: '#FFC72C',
          600: '#E6B328',
          700: '#CC9F23',
          800: '#99771A',
          900: '#664F11'
        },
        accent: {
          50: '#FFF8F0',
          100: '#FFF1E0',
          200: '#FFE3C2',
          300: '#FFC999',
          400: '#FFAE70',
          500: '#FF8C00',
          600: '#E67E00',
          700: '#CC7000',
          800: '#995400',
          900: '#663800'
        },
        dark: {
          50: '#F0F0F0',
          100: '#E0E0E0',
          200: '#C2C2C2',
          300: '#999999',
          400: '#707070',
          500: '#1A1A1A',
          600: '#171717',
          700: '#141414',
          800: '#101010',
          900: '#0D0D0D'
        },
        light: '#F8F8F8',
        success: '#4CAF50',
        warning: '#FF9800',
        danger: '#F44336',
        info: '#2196F3'
      },
      fontFamily: {
        sans: ['"Poppins"', 'sans-serif']
      }
    }
  },
  plugins: [],
} 