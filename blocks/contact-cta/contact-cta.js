import { useTabs } from '@shared/hooks/tabs';

if (window.matchMedia('(min-width: 1024px)').matches) {
  const form = document.querySelector('[data-contact-form]');

  useTabs(form, 'active');
}
