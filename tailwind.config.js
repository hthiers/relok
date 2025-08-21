/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./views/tasksnew/**/*.php",
    "./views/**/*.js",
    // Agrega más rutas si luego expandes el uso
  ],
  theme: { extend: {} },
  plugins: [],
  // Claves para controlar alcance y evitar colisiones:
  prefix: "tw-",                // usarás clases como tw-flex, tw-text-sm, etc.
  corePlugins: { preflight: false }, // NO resetea tu CSS base existente
}
