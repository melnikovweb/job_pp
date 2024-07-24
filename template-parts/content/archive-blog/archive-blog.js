import { useLoadItems } from '@shared/hooks/load-items';
import { html } from '@shared/services/dom-services';

const showMoreButton = document.querySelector('[data-action="show-more"]');
const totalCount = +showMoreButton.dataset.count;
const taxQuery = window.SECRET_archive_blog?.taxQuery ?? null;

const { next$, isAllItemsLoaded } = useLoadItems({
  type: 'post',
  limit: 5,
  offset: 8,
  totalCount,
  container: document.querySelector('[data-container="posts"]'),
  template: 'post-item/load-items',
  categories: taxQuery,
  wrapper(template) {
    return html` <div class="col-span-full *:h-full">${template}</div> `;
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
