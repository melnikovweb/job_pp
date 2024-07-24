class SearchService {
  #QUERY_CACHE_KEY = 'SECRETCacheQueries';

  setQueryCache(newItem, postType) {
    const MAX_STACK_LENGTH = 5;
    const queryChacheName = this.#QUERY_CACHE_KEY + postType;
    const items = this.getQueryCache(postType);
    const isUnique = !items.find((item) => item.url === newItem.url);

    if (isUnique) {
      items.unshift(newItem);
    }

    localStorage.setItem(queryChacheName, JSON.stringify(items.splice(0, MAX_STACK_LENGTH)));
  }

  getQueryCache(postType) {
    const queryChacheName = this.#QUERY_CACHE_KEY + postType;
    const store = localStorage.getItem(queryChacheName);
    const items = store ? JSON.parse(store) : [];

    return items;
  }

  renderQueries(container, options, query) {
    container.innerHTML = '';
    container.append(
      ...options.map((option) => {
        const { url, title } = option;
        const element = document.createElement(url ? 'a' : 'span');

        element.innerHTML = query ? title.replace(new RegExp(this.escapeRegExp(query), 'gi'), `<span class="text-blue-600 bg-transparent">$&</span>`) : title;


        element.classList.toggle('pointer-events-none', !url);

        element.dataset.json = JSON.stringify(option);

        if (url) {
          element.href = url;
        }

        return element;
      }),
    );
  }

  async getPosts$(ajaxUrl, data) {
    const result = await fetch(ajaxUrl, {
      method: 'POST',
      body: data,
    });

    return result.json();
  }

  getFormData(query, postType, nonce) {
    const formData = new FormData();

    formData.append('action', 'search');
    formData.append('post_type', postType);
    formData.append('nonce', nonce);
    formData.append('s', query);

    return formData;
  }

  escapeRegExp(string) {
    return string.replace(/[^\w\s]/g, '\\$&');
  }
}

export const searchService = new SearchService();
