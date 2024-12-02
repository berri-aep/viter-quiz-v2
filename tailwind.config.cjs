/** @type {import('tailwindcss').Config} */

const colors = [
  "myred",
  "myyellow",
  "accent",
  "light",
  "dark",
  "orange",
  "primary",
  "secondary",
  "line",
  "alert",
  "success",
  "warning",
  "info",
  "body",
];

const colorObject = colors.reduce((acc, color) => {
  acc[color] = `rgba(var(--${color}), <alpha-value>)`;
  return acc;
}, {});

export default {
  content: ["./src/**/*.{js,ts,jsx,tsx}"],
  theme: {
    extend: {
      textColor: colorObject,
      backgroundColor: colorObject,
      borderColor: colorObject,
      stroke: colorObject,
      fill: colorObject,
      animation: {
        rotate: "rotate 2s linear infinite",
        loading: "loading 1.5s ease-in infinite",
        shake: "shake 0.5s ease-in both",
      },

      backgroundImage: {
        skeleton:
          "linear-gradient(90deg, transparent, rgba(var(--secondary), .8), transparent)",
      },

      keyframes: {
        rotate: {
          "100%": { transform: "rotate(360deg)" },
        },
        loading: {
          "0%": { transform: "translateX(-100%)" },
          "100%": { transform: "translateX(100%)" },
        },

        shake: {
          "10%, 90%": { transform: "translate3d(-1px, 0, 0)" },
          "20%, 80%": { transform: "translate3d(2px, 0, 0)" },
          "30%, 50%, 70%": { transform: "translate3d(-4px, 0, 0)" },
          "40%, 60%": { transform: "translate3d(4px, 0, 0)" },
        },
      },
    },
  },
  plugins: [],
};
