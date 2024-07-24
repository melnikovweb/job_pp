import { useFilters } from '@shared/hooks/filters';
import Choices from 'choices.js';

const selects = document.querySelectorAll('select[data-filter-type="taxonomy"]') || [];

selects.forEach(function (select) {
  const choices = new Choices(select, {
    removeItemButton: true,
  });

  if (choices) {
    select.addEventListener('change', selects);
  }
});

useFilters('vacancy');
