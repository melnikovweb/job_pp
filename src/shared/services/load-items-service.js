class LoadItemsService {
  /**
   * @typedef {Object} State
   * Represents the state of posts fetched by the service.
   * @property {string} nonce - A unique identifier used for verification purposes.
   * @property {string} action - A unique identifier used for WP action.
   * @property {string} type - The type of posts being fetched. Supports types like 'news'.
   * @property {number} limit - The maximum number of entries to return. If the value exceeds the maximum, then the maximum value will be used.
   * @property {number} offset - The (zero-based) offset of the first item returned in the collection. In a zero-based offset 0 is a correct value.
   * @property {string} template - Template part name
   * @property {Object.<string, Array.<string>>} categories - A map of taxonomy keys to their respective slugs, indicating the categories of the posts.
   * @property {Array.<Object>} meta - An array of meta data objects for additional filtering criteria.
   */

  /**
   * Fetches posts from the backend using state parameters. Constructs a FormData object to include in the POST request.
   * This method is designed to work with WordPress backend configurations, utilizing an 'action' and a 'nonce' for security.
   *
   * @param {State} state - The state object containing parameters for the fetch request.
   * @returns {Promise<Object>} A promise that resolves with the fetched posts' data.
   * @throws {Error} Throws an error if the fetch operation fails or the response status is not OK.
   */
  async getItems$(state) {
    try {
      const response = await fetch(window.WP.ajaxUrl, {
        method: 'POST',
        credentials: 'same-origin',
        body: this.#getFormData({
          ...this.getInitialState(),
          ...state,
        }),
      });

      if (!response.ok) {
        throw new Error(`Error: ${response.status}`);
      }

      return await response.json();
    } catch (error) {
      console.error('Failed to fetch posts:', error);
      throw error;
    }
  }

  /**
   * Provides a default initial state, including defaults for pagination, type, and other necessary parameters.
   * This method is called when no existing state is found in localStorage or when initializing the service.
   *
   * @returns {State} An initial state object with default settings.
   */
  getInitialState() {
    return {
      limit: 10,
      action: 'load_items',
      offset: 0,
      type: null,
      nonce: window.WP.nonce,
      categories: null,
      template: null,
      meta: null,
    };
  }

  /**
   * Constructs a FormData object from a given state, preparing it for sending in a POST request.
   * This private method handles serialization of complex objects like 'categories' and 'meta'.
   *
   * @param {State} state - The state parameters for the fetch request.
   * @returns {FormData} The constructed FormData object.
   * @private
   */
  #getFormData(state) {
    const formData = new FormData();

    formData.append('nonce', state.nonce);
    formData.append('action', state.action);
    formData.append('type', state.type);
    formData.append('per_page', state.limit);
    formData.append('offset', state.offset);
    formData.append('template-part', state.template);
    formData.append('categories', JSON.stringify(state.categories));
    formData.append('meta', JSON.stringify(state.meta));

    return formData;
  }
}

export const loadItemsService = new LoadItemsService();
