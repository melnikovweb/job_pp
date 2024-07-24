class EventsService {
  #NONCE = window.WP.nonce;
  #AJAX_URL = window.WP.ajaxUrl;

  getFormData(rawData = {}) {
    const formData = new FormData();
    const data = Object.assign(
      {
        action: 'filter_events_by_type',
        eventType: [],
        year: [],
      },
      rawData,
    );

    formData.append('action', data.action);
    formData.append('event_type', data.eventType);
    formData.append('year', data.year);
    formData.append('nonce', this.#NONCE);

    return formData;
  }

  async getEvents$(filters = {}) {
    const body = this.getFormData(filters);

    const response = await fetch(this.#AJAX_URL, {
      method: 'POST',
      body,
    });

    return response;
  }
}

export const eventsService = new EventsService();
