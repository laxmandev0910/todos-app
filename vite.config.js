import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "tailwindcss";
import tailwindConfig from "./tailwind.config.js";
import autoprefixer from "autoprefixer";
export default defineConfig({
  plugins: [
    laravel({
      buildDirectory: "theme",
      input: ["resources/theme/css/style.css", "resources/theme/js/script.js"],
      refresh: true,
    }),
  ],
  css: {
    postcss: {
      plugins: [
        tailwindcss({
          config: tailwindConfig,
        }),
        autoprefixer,
      ],
    },
  },
});
