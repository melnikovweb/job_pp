class SearchService {
  static #subscribers = [];

  observer(input) {
    input.addEventListener('input', (event) => {
      SearchService.#subscribers.forEach((subscriber) => {
        subscriber(event.target.value);
      });
    });

    return {
      subscribe(callback) {
        SearchService.#subscribers.push(callback);
      },
    };
  }
}

export const searchService = new SearchService();
