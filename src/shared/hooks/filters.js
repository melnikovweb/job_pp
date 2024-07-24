import { filtersServices } from '@shared/services/filters-services.js';

export function useFilters(type) {
  const filterContainers = document.querySelectorAll('.filters-container');
  const dataFilterTypeAttribute = 'data-filter-type';
  const dataFilteredByAttribute = 'data-filteredby';

  filterContainers.forEach((container) => {
    const filters = container.querySelectorAll(`[${dataFilterTypeAttribute}]`);
    const filterContentContainer = container.querySelector('.filter-content-container');

    filters.forEach((filter) => {
      filter.addEventListener('change', async () => {
        try {
          const formData = filtersServices.prepareFormData(filters, window.WP.nonce, dataFilterTypeAttribute, dataFilteredByAttribute, type);
          const html = await filtersServices.filterEvents(formData, window.WP.ajaxUrl);
          filtersServices.renderContent(html, filterContentContainer);
        } catch (error) {
          console.error(error);
        }
      });
    });
  });
}
