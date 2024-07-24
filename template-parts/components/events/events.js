import { useLoadItems } from '@shared/hooks/load-items';
import { html } from '@shared/services/dom-services';
import { eventsService } from './services/events-service';
import { useFilter } from './hooks/filter';

const eventTypeSelect = document.querySelector('[data-event-filter="type"]');
const eventYearSelect = document.querySelector('[data-event-filter="year"]');
const showMoreButton = document.querySelector('[data-action="show-more"]');
const eventsContainer = document.querySelector('#events-container');

const filter = useFilter();
const { next$, isAllItemsLoaded } = useLoadItems({
  type: 'event',
  limit: 2,
  offset: 4,
  totalCount: +showMoreButton.dataset.count,
  container: document.querySelector('[data-container="posts"]'),
  template: 'event-item/load-items',
  meta: [
    {
      key: 'end_date',
      value: new Date().toISOString().slice(0, 10).replace(/-/g, ''),
      compare: '<',
      type: 'DATE',
    },
  ],
  wrapper(template) {
    return html`${template}`;
  },
});

const eventYearFilter = filter.create(eventYearSelect);
const eventTypeFilter = filter.create(eventTypeSelect);

const onFiltersChange = async () => {
  try {
    const response = await eventsService.getEvents$({
      eventType: eventTypeFilter.getValue(true),
      year: eventYearFilter.getValue(true),
    });

    if (!response.ok) {
      throw Error(response.statusText);
    }

    const { success, data } = await response.json();

    if (!success) {
      return;
    }

    const style = eventsContainer.querySelector('style');
    const posts = data.map(({ post }) => html`${post}`);

    eventsContainer.innerHTML = '';

    if (style) {
      eventsContainer.append(style);
    }

    eventsContainer.append(...posts);
  } catch (error) {
    console.error('Error:', error);
  }
};

eventTypeFilter.onChange(onFiltersChange);
eventYearFilter.onChange(onFiltersChange);

showMoreButton.addEventListener('click', async () => {
  await next$();

  const isLoaded = isAllItemsLoaded();

  if (!isLoaded) {
    return;
  }

  showMoreButton.classList.add('hidden');
});
