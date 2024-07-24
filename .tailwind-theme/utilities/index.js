import plugin from 'tailwindcss/plugin';
import { getTypography } from './typography';
import { getEncodedIcons } from './encoded-icons';
import { getNoScroll } from './no-scroll.js';

export const Utilities = plugin(({ addUtilities, theme }) => {
  addUtilities({
    ...getTypography(),
    ...getEncodedIcons(),
    ...getNoScroll(),
  })
});
