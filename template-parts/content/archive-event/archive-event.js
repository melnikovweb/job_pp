import { useLoadItems } from '@shared/hooks/load-items';
import { html } from '@shared/services/dom-services';
import Choices from 'choices.js';

// todo - add state to keep selects values
const eventTypeFilter = document.querySelector('[data-event-filter="type"]');
const eventYearFilter = document.querySelector('[data-event-filter="year"]');

const selects = [eventYearFilter, eventTypeFilter];
const today = new Date().toISOString().slice(0, 10).replace(/-/g, '');

const initChoices = (select) => {
  return new Choices(select, {
    removeItemButton: true,
    itemSelectText: '',
    callbackOnCreateTemplates() {
      return {
        item: ({ classNames }, data) => {
          const highlightedClasses = data.highlighted ? classNames.highlightedState : classNames.itemSelectable;
          // TODO: Add close button
          // <button
          //   type="button"
          //   data-button
          //   aria-label="Remove item: '${data.label}'">
          //   <svg
          //     class="size-4"
          //     xmlns="http://www.w3.org/2000/svg"
          //     viewBox="0 0 12 12"
          //     fill="none">
          //     <path
          //       d="M2.25467 1.52787C2.0541 1.3273 1.72892 1.3273 1.52835 1.52787C1.32779 1.72843 1.32779 2.05361 1.52835 2.25418L5.27384 5.99966L1.52835 9.74515C1.32779 9.94571 1.32779 10.2709 1.52835 10.4715C1.72892 10.672 2.0541 10.672 2.25467 10.4715L6.00015 6.72597L9.74564 10.4715C9.9462 10.672 10.2714 10.672 10.4719 10.4715C10.6725 10.2709 10.6725 9.94571 10.4719 9.74515L6.72646 5.99966L10.4719 2.25418C10.6725 2.05361 10.6725 1.72843 10.4719 1.52787C10.2714 1.3273 9.9462 1.3273 9.74564 1.52787L6.00015 5.27335L2.25467 1.52787Z"
          //       fill="currentcolor"
          //     />
          //   </svg>
          // </button>;

          return html`
            <div
              class="${highlightedClasses} flex items-center gap-2 rounded-full bg-blue-600 px-2 py-1 text-white font-b3"
              ${data.active ? 'aria-selected="true"' : ''}
              ${data.disabled ? 'aria-disabled="true"' : ''}
              data-item
              data-id="${data.id}"
              data-value="${data.value}">
              ${data.label}
            </div>
          `;
        },
      };
    },
  });
};

const [eventYearControl, eventTypeControl] = selects.map((select) => {
  const conrol = initChoices(select);
  select.addEventListener('change', filterEvents);
  return conrol;
});

//  TODO change get data logic from select to Choices

const getFilterValue = (conrol) => {
  const items = conrol._currentState.items;
  return items.map((item) => item.value);
};

const getFormData = () => {
  const formData = new FormData();

  formData.append('action', 'filter_events_by_type');
  formData.append('event_type', getFilterValue(eventTypeControl));
  formData.append('year', getFilterValue(eventYearControl));
  formData.append('nonce', window.WP.nonce);

  return formData;
};

async function filterEvents() {
  try {
    const response = await fetch(window.WP.ajaxUrl, {
      method: 'POST',
      body: getFormData(),
    });

    if (!response.ok) {
      throw Error(response.statusText);
    }

    const data = await response.json();

    if (data.success) {
      updatePageContent(data.data);
    }
  } catch (error) {
    console.error('Error:', error);
  }
}

function updatePageContent(events) {
  const container = document.querySelector('#events-container');
  const style = container.querySelector('style');
  container.innerHTML = style;

  events.forEach((event) => {
    container.append(html` ${event.post} `);
  });
}

const showMoreButton = document.querySelector('[data-action="show-more"]');
const totalCount = +showMoreButton.dataset.count;

const { next$, isAllItemsLoaded } = useLoadItems({
  type: 'event',
  limit: 2,
  offset: 4,
  totalCount,
  container: document.querySelector('[data-container="posts"]'),
  template: 'event-item/load-items',
  meta: [
    {
      key: 'end_date',
      value: today,
      compare: '<',
      type: 'DATE',
    },
  ],
  wrapper(template) {
    return html`${template}`;
  },
});

showMoreButton.addEventListener('click', async () => {
  await next$();

  const isLoaded = isAllItemsLoaded();

  if (!isLoaded) {
    return;
  }

  showMoreButton.classList.add('hidden');
});
