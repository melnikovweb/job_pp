import { classesService } from '@shared/services/classes-service';
import { searchService } from '@shared/services/search-service';

export function useSearch({ postType }) {
  const inputElement = document.querySelector('[data-id="search"]');
  const queriesElement = document.querySelector('[data-id="search-queries-list"]');
  const queriesContainerElement = document.querySelector('[data-id="search-queries-container"]');

  const SEARCH_DELAY = 300;
  const MIN_SEARCH_QUERY = 3;
  const ACTIVE_CONTAINER_CLASSES = 'block';
  const DEFAULT_CONTAINER_CLASSES = 'hidden';

  let searchTimeout = null;
  let isProcessing = false;
  let options = [];

  const control = new Proxy(
    {
      query: inputElement.value,
      isQueriesShown: false,
    },
    {
      set(target, key, value) {
        const cachedQueries = searchService.getQueryCache(postType);

        switch (key) {
          case 'isQueriesShown':
            if (!options.length) {
              return Reflect.set(target, key, false);
            }

            classesService.toggleList(queriesContainerElement, ACTIVE_CONTAINER_CLASSES, value);
            classesService.toggleList(queriesContainerElement, DEFAULT_CONTAINER_CLASSES, !value);

            return Reflect.set(target, key, value);
          case 'query':
            if (value.length < MIN_SEARCH_QUERY && cachedQueries.length) {
              options = cachedQueries;
              searchService.renderQueries(queriesElement, options);

              return Reflect.set(target, key, value);
            }

            if (value.length < MIN_SEARCH_QUERY || (isProcessing && !searchTimeout)) {
              return Reflect.set(target, key, value);
            }

            isProcessing = true;

            searchTimeout = setTimeout(() => {
              searchService.getPosts$(window.WP.ajaxUrl, searchService.getFormData(value, postType, window.WP.nonce)).then((items) => {
                options = items;
                searchService.renderQueries(queriesElement, options, value);

                control.isQueriesShown = true;
                isProcessing = false;
              });

              searchTimeout = null;
            }, SEARCH_DELAY);

            return Reflect.set(target, key, value);
        }
      },
    },
  );

  inputElement.addEventListener('focus', () => {
    if (control.query.length < MIN_SEARCH_QUERY) {
      options = searchService.getQueryCache(postType);
      searchService.renderQueries(queriesElement, options);
    } else {
      control.query = inputElement.value;
    }

    control.isQueriesShown = true;
  });
  inputElement.addEventListener('blur', () => (control.isQueriesShown = false));
  inputElement.addEventListener('input', () => {
    control.isQueriesShown = true;
    control.query = inputElement.value;
  });

  queriesElement.addEventListener('pointerdown', (event) => {
    if (event.target.nodeName !== 'A') {
      return;
    }

    const data = JSON.parse(event.target.dataset.json);

    if (window.location.href === data.url) {
      return;
    }

    window.location.href = data.url;
    searchService.setQueryCache(data, postType);
  });

  return [];
}
