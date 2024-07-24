const fontTypes = [
  {
    prefix: 'headline',
    amount: 5,
  },
  {
    prefix: 'title',
    amount: 4,
  },
  {
    prefix: 'body',
    amount: 5,
  },
  {
    prefix: 'additional',
    amount: 1,
  }
  
];

export const getTypography = () => fontTypes.reduce((result, options) => {
  for (let step = 1; step <= options.amount; step++) {
    result[`.font-${options.prefix[0]}${step}`] = {
      'font': `var(--font-${options.prefix}-${step})`,
    }
  }

  return result;
}, {});

