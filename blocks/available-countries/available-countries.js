import { tabsService } from '@shared/services/tabs-service';
import { searchService } from './services/search-service';
import { useShowMore } from './hooks/show-more';

const showMoreControl = useShowMore();

const notFoundTemplate = document.querySelector('[data-not-found="available-countries"]');
const searchInput = document.querySelector('[data-control="search"]');
const controlsWrapperElement = document.querySelector('[data-container="tabs-control"]');
const contentWrapperElement = document.querySelector('[data-container="tabs-content"]');

if (!(searchInput instanceof HTMLElement)) {
  console.error('Search input element not found or invalid.');
}

if (!(controlsWrapperElement instanceof HTMLElement)) {
  console.error('Controls wrapper element not found or invalid.');
}

if (!(contentWrapperElement instanceof HTMLElement)) {
  console.error('Content wrapper element not found or invalid.');
}

if (searchInput && controlsWrapperElement && contentWrapperElement) {
  const searchObserver = searchService.observer(searchInput);

  const tabsControl = tabsService.create({
    controlsWrapperElement,
    contentWrapperElement,
    contentValueAttr: 'data-region',
  });

  if (!tabsControl) {
    console.error('Tabs service failed to initialize.');
  } else {
    searchObserver.subscribe(() => tabsControl.setActiveTab('All'));
    tabsControl.onChange(() => showMoreControl.update());

    tabsControl.contentList.forEach((content) => {
      const countries = [...content.querySelectorAll('[data-search-queries]')];
      if (countries.length === 0) {
        console.error('No countries found for searching.');
        return;
      }

      const { parentElement } = countries[0];

      searchObserver.subscribe((value) => {
        const matchCountries = countries.filter((country) => {
          const queries = country.dataset.searchQueries.toLowerCase();
          return queries.includes(value.toLowerCase());
        });

        parentElement.innerHTML = '';
        parentElement.append(...matchCountries);

        controlsWrapperElement.classList.toggle('is-searching', !!value);
        content.classList.toggle('is-searching', !!value);

        if (!matchCountries.length) {
          const notFoundContent = notFoundTemplate.content.cloneNode(true);
          parentElement.append(notFoundContent);
        }

        showMoreControl.update();
      });
    });
  }
}
