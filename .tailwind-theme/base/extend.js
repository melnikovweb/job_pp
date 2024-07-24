import { spacing } from './spacing';
import { prose } from './prose';
import { keyframes } from './keyframes';
import { animation } from './animation';

export const extend = {
  size: spacing,
  keyframes,
  animation,
  typography(theme) {
    return prose(theme)
  }
}

