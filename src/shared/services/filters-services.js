class FiltersService {
  async fetchFilteredData(formData, ajaxUrl) {
    const result = await fetch(ajaxUrl, {
      method: 'POST',
      body: formData,
    });
    return result.text();
  }

  async filterEvents(formData, ajaxUrl) {
    return await this.fetchFilteredData(formData, ajaxUrl);
  }

  renderContent(html, contentContainer) {
    contentContainer.innerHTML = html;
  }

  prepareFormData(filters, nonce, dataFilterTypeAttribute, dataFilteredByAttribute, type) {
    const selectedValues = Array.from(filters).map(filter => ({
      filterType: filter.getAttribute(dataFilterTypeAttribute),
      filteredBy: filter.getAttribute(dataFilteredByAttribute),
      value: filter.value
    }));

    const formData = new FormData();
    formData.append('action', 'filters');
    formData.append('type', type);
    formData.append('data', JSON.stringify(selectedValues));
    formData.append('nonce', nonce);
    return formData;
  }
}

export const filtersServices = new FiltersService();
