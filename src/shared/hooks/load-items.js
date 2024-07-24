import { loadItemsService } from '@shared/services/load-items-service';
import { KEY_CODES } from 'choices.js';

/**
 * Creates an interface to manage and display items loaded by the loadItemsService, based on specified criteria such as key and type,
 * and supports pagination through offset and limit. Initializes the state with these parameters and offers methods to fetch and render posts
 * according to the current state, as well as update the state with new filters or pagination settings. The rendering utilizes a provided
 * template function for individual items and a container for appending the rendered elements.
 *
 * @param {Object} params - Parameters to initialize the state and configure rendering.
 * @param {string} params.type - The type of posts to fetch and manage, e.g., 'news', 'events'.
 * @param {number} params.limit - The number of items to fetch per request.
 * @param {number} params.offset - The initial offset for fetching items.
 * @param {number} params.totalCount - Total items count
 * @param {string} params.template - Template part name
 * @param {Object} params.categories - categories
 *                 - 'category': Category slug
 * @param {Object} params.meta - Meta information for the item type
 * @param {function} params.wrapper - A function that takes an item and returns an HTMLElement or HTML string for rendering.
 * @param {Element} params.container - A DOM element where the rendered items are to be appended.
 * @returns {Object} An object containing methods to update the state and trigger re-rendering of items:
 *                   - `next`: Applies new filters or handles pagination.
 *                   - `isAllItemsLoaded`: Check if all items were loaded
 */
export function useLoadItems({ type, limit, offset, totalCount, wrapper, container, template, meta, categories }) {
  const initialOffset = offset;
  // TODO: Check the multiple categories filter
  const state = {
    ...loadItemsService.getInitialState(),
    ...{ type, limit, offset, totalCount, template, meta, categories },
  };

  const control = new Proxy(
    {
      isAllItemsLoaded: false,
      currentOffset: offset,
      currentLimit: limit,
      itemsLoadedCount: 0,
    },
    {
      set(target, key, value) {
        if (key === 'itemsLoadedCount') {
          const currentLimit = Reflect.get(target, 'currentLimit');
          const currentOffset = Reflect.get(target, 'currentOffset');

          if (totalCount) {
            const isAllItemsLoaded = totalCount <= currentOffset + currentLimit;

            Reflect.set(target, 'isAllItemsLoaded', isAllItemsLoaded);
          } else {
            Reflect.set(target, 'isAllItemsLoaded', currentLimit > value);
          }
        }

        return Reflect.set(...arguments);
      },
    },
  );

  const isAllItemsLoaded = () => control.isAllItemsLoaded;

  const render$ = async () => {
    if (!template || !container) {
      console.error('The Template name or Container element is missing.');
      return;
    }

    try {
      const { data } = await loadItemsService.getItems$(state);
      const items = wrapper ? data.map((item) => wrapper(item)) : data;

      control.itemsLoadedCount = data.length;
      control.currentOffset += limit;

      container.append(...items);
    } catch (error) {
      console.error('Failed to fetch items:', error);
    }
  };

  const next$ = async (filters = null) => {
    if (control.isAllItemsLoaded) {
      console.warn('All items were loaded');
      return;
    }

    await render$();

    if (filters && Object.keys(filters).length) {
      Object.assign(state, { categories: filters }, { offset: initialOffset });
    } else {
      Object.assign(state, { offset: control.currentOffset });
    }
  };

  return { next$, isAllItemsLoaded };
}
