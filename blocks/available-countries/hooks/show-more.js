/**
 * Initializes the show more functionality for specified containers.
 * @param {Object} [options={}] - Configuration options for the show more functionality.
 * @param {string} [options.containerSelector='[data-show-more="container"]'] - Selector for the container element.
 * @param {string} [options.contentSelector='[data-show-more="content"]'] - Selector for the content element.
 * @param {string} [options.actionSelector='[data-show-more="action"]'] - Selector for the action element.
 * @returns {Object} - An object containing methods to add a change event listener and update the overflow state.
 */
export function useShowMore(options = {}) {
  const EVENT_TOGGLE_NAME = 'on-show-more-toggle';

  const { containerSelector, contentSelector, actionSelector } = Object.assign(
    {
      containerSelector: '[data-show-more="container"]',
      contentSelector: '[data-show-more="content"]',
      actionSelector: '[data-show-more="action"]',
    },
    options,
  );

  const containers = [...document.querySelectorAll(containerSelector)];

  if (!containers.length) {
    console.error(`No containers found with the selector: ${containerSelector}`);
    return;
  }

  containers.forEach((container) => {
    const content = container.querySelector(contentSelector);
    const action = container.querySelector(actionSelector);

    if (!content) {
      console.error(`No content element found in the container with the selector: ${contentSelector}`);
      return;
    }

    if (!action) {
      console.error(`No action element found in the container with the selector: ${actionSelector}`);
      return;
    }

    action.addEventListener('click', () => {
      const changeEvent = new CustomEvent(EVENT_TOGGLE_NAME, {
        detail: {
          container,
          content,
          action,
        },
      });

      container.classList.toggle('is-shown');

      document.body.dispatchEvent(changeEvent);
    });

    container.classList.toggle('is-overflow', content.offsetHeight < content.scrollHeight);
  });

  /**
   * Updates the overflow state of the containers.
   */
  const update = () => {
    containers.forEach((container) => {
      const content = container.querySelector(contentSelector);
      const action = container.querySelector(actionSelector);

      if (!content) {
        console.error(`No content element found in the container with the selector: ${contentSelector}`);
        return;
      }

      if (!action) {
        console.error(`No action element found in the container with the selector: ${actionSelector}`);
        return;
      }

      container.classList.toggle('is-overflow', content.scrollHeight > content.clientHeight);
    });
  };

  update();

  return {
    /**
     * Adds an event listener for the show more toggle events.
     * @param {Function} callback - The callback function to call when the show more toggle event occurs.
     */
    onChange(callback) {
      document.body.addEventListener(EVENT_TOGGLE_NAME, ({ detail }) => callback(detail));
    },
    update,
  };
}
