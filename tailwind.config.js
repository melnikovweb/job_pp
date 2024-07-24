import { SAFELIST, THEME, Utilities } from './.tailwind-theme';

const MODULE_NAME = process.env.MODULE_NAME;
const COMMON_MODULES = ['core', 'shared'];

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    `./src/shared/**/*.js`,
    `./${process.env.UNIX_ENTRY_PATH}/**/*.js`,
    `./${process.env.UNIX_ENTRY_PATH}/html/**/*.php`,
  ],
  important: !COMMON_MODULES.includes(MODULE_NAME) && `.${process.env.MODULE_NAME}`,
  safelist: SAFELIST,
  plugins: [
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms')({
      strategy: 'base',
    }),
    Utilities,
  ],
  corePlugins: {
    container: false,
  },
  theme: THEME,
};
