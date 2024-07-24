const noScroll = {
  '.no-scroll': {
    '::-webkit-scrollbar' : {
      'display': 'none'
    }
  }
}

export function getNoScroll() {
  return noScroll;
}
