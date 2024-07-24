export const prose = (theme) => ({
  secondary: {
    css: {
      'ul > li': {
        display: 'block',
        position: 'relative',
        '&:before': {
          position: 'absolute',
          top: '0.5em',
          left: 0,
          content: '""',
          display: 'block',
          height: '12px',
          width: '12px',
          translate: 'calc(-100% - 1rem) 0',
          borderRadius: '100vmax',
          backgroundColor: theme('colors.blue.600'),
        }
      }
    }
  },
  DEFAULT: {
    css: {
      color: theme('colors.gray.800'),
      maxWidth: 'none',
      '*': {
        '&:first-child': {
          marginTop: 0,
        },
      },
      p: {
        font: 'var(--font-body-2)',
        marginBlock: theme('spacing.4'),
      },
      li: {
        font: 'var(--font-body-2)',
        marginTop: theme('spacing.4'),
        marginBottom: theme('spacing.2')
      },
      h1: {
        font: 'var(--font-headline-1)',
        marginTop: theme('spacing.4'),
        marginBottom: theme('spacing.2')
      },
      h2: {
        font: 'var(--font-headline-2)',
        marginTop: theme('spacing.4'),
        marginBottom: theme('spacing.2')
      },
      h3: {
        font: 'var(--font-headline-3)',
        marginTop: theme('spacing.4'),
        marginBottom: theme('spacing.2')
      },
      h4: {
        font: 'var(--font-headline-4)',
        marginTop: theme('spacing.4'),
        marginBottom: theme('spacing.2')
      },
      h5: {
        font: 'var(--font-headline-5)',
        marginTop: theme('spacing.4'),
        marginBottom: theme('spacing.2')
      },
      a: {
        transition: 'color 150ms ease-in',
        font: 'var(--font-body-2)',
        textDecoration: 'none',
        color: theme('color.blue.600'),
        '&:hover': {
          color: theme('colors.blue.800'),
        }
      },
      li: {
        font: 'var(--font-body-2)',
      },
      figure: {
        marginBlock: theme('spacing.4'),
      },
      ul: {
        marginBlock: theme('spacing.4'),
      },
      ol: {
        paddingLeft: '0',
        listStyleType: 'none',
        counterReset: 'numeric',
      },
      'ol > li': {
        counterIncrement: 'numeric',
        '&:before': {
          content: 'counters(numeric,".") "."',
          paddingRight: '.36em',
        }
      }
    },
  },
  md: {
    css: {
      color: theme('colors.gray.800'),
      maxWidth: 'none',
      p: {
        font: 'var(--font-body-2)',
        marginBlock: theme('spacing.10'),
      },
      li: {
        font: 'var(--font-body-2)',
      },
      h1: {
        font: 'var(--font-headline-1)',
        marginTop: theme('spacing.10'),
        marginBottom: theme('spacing.6')
      },
      h2: {
        font: 'var(--font-headline-2)',
        marginTop: theme('spacing.10'),
        marginBottom: theme('spacing.6')
      },
      h3: {
        font: 'var(--font-headline-3)',
        marginTop: theme('spacing.10'),
        marginBottom: theme('spacing.6')
      },
      h4: {
        font: 'var(--font-headline-4)',
        marginTop: theme('spacing.10'),
        marginBottom: theme('spacing.6')
      },
      h5: {
        font: 'var(--font-headline-5)',
        marginTop: theme('spacing.10'),
        marginBottom: theme('spacing.6')
      },
      a: {
        transition: 'color 150ms ease-in',
        font: 'var(--font-body-2)',
        color: theme('colors.blue.600'),
        '&:hover': {
          color: theme('colors.blue.800'),
        }
      },
      ul: {
        marginBlock: theme('spacing.10'),
      },
      figure: {
        marginBlock: theme('spacing.10'),
      },
      ol: {
        paddingLeft: '0',
        listStyleType: 'none',
        counterReset: 'numeric',
      },
      'ol > li': {
        counterIncrement: 'numeric',
        '&:before': {
          content: 'counters(numeric,".") "."',
          paddingRight: '.36em',
        }
      },
    },
  },
});
