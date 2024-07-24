'use strict';

module.exports = {
  extends: [
    'stylelint-config-standard-scss',
    'stylelint-config-tailwindcss/scss',
    './.stylelint/rules',
    './.stylelint/properties-order',
    './.stylelint/scss-rules',
    './.stylelint/prettier',
  ],
};
