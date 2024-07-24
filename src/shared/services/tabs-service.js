/**
 * TabsService class to manage tab controls and their associated content.
 */
class TabsService {
  #defaultOptions = {
    controlsWrapperElement: null,
    contentWrapperElement: null,
    controlValueAttr: 'data-value',
    contentValueAttr: 'data-value',
  };

  /**
   * Creates a tab service instance with the provided options.
   * @param {Object} [options={}] - Configuration options for the tab service.
   * @param {HTMLElement} [options.controlsWrapperElement] - The wrapper element containing tab controls.
   * @param {HTMLElement} [options.contentWrapperElement] - The wrapper element containing tab contents.
   * @param {string} [options.controlValueAttr='data-value'] - Attribute used to identify tab controls.
   * @param {string} [options.contentValueAttr='data-value'] - Attribute used to identify tab contents.
   * @returns {Object|null} - An object containing the selected tab and methods to interact with the tabs, or null if initialization fails.
   */
  create(options = {}) {
    const EVENT_CHANGE_NAME = 'on-tab-changed';
    const ACTIVE_CLASS_NAME = 'active';

    const { controlsWrapperElement, contentWrapperElement, controlValueAttr, contentValueAttr } = Object.assign(
      this.#defaultOptions,
      options,
    );

    if (!(controlsWrapperElement instanceof HTMLElement) || !(contentWrapperElement instanceof HTMLElement)) {
      console.error('Both controlsWrapperElement and contentWrapperElement must be valid HTMLElement instances.');
      return null;
    }

    const tabs = [...controlsWrapperElement.querySelectorAll(`[${controlValueAttr}]`)];
    const contentList = [...contentWrapperElement.querySelectorAll(`[${contentValueAttr}]`)];

    if (tabs.length === 0 || contentList.length === 0) {
      console.error('No tabs or content elements found.');
      return null;
    }

    const activeTab = tabs.find((element) => element.classList.contains(ACTIVE_CLASS_NAME)) ?? tabs[0];
    const activeContent =
      contentList.find((element) => element.classList.contains(ACTIVE_CLASS_NAME)) ?? contentList[0];

    activeTab.classList.add(ACTIVE_CLASS_NAME);
    activeContent.classList.add(ACTIVE_CLASS_NAME);

    const value = activeTab.getAttribute(controlValueAttr);

    const rawControl = {
      selected: value,
    };

    const control = new Proxy(rawControl, {
      set(target, key, value) {
        const onChange = new CustomEvent(EVENT_CHANGE_NAME, {
          detail: {
            selected: value,
          },
        });

        tabs.forEach((element) => {
          const currentValue = element.getAttribute(controlValueAttr);
          element.classList.toggle(ACTIVE_CLASS_NAME, currentValue === value);
        });

        contentList.forEach((element) => {
          const currentValue = element.getAttribute(contentValueAttr);
          element.classList.toggle(ACTIVE_CLASS_NAME, currentValue === value);
        });

        controlsWrapperElement.dispatchEvent(onChange);
        return Reflect.set(target, key, value);
      },
    });

    controlsWrapperElement.addEventListener('click', (event) => {
      const tab = event.target.closest(`[${controlValueAttr}]`);
      if (!tab) {
        return;
      }
      control.selected = tab.getAttribute(controlValueAttr) ?? '';
    });

    return {
      /**
       * Gets the currently selected tab.
       * @returns {string} - The selected tab value.
       */
      get selected() {
        return control.selected;
      },
      /**
       * Adds an event listener for tab change events.
       * @param {Function} callback - The callback function to call when the tab changes.
       */
      onChange(callback) {
        controlsWrapperElement.addEventListener(EVENT_CHANGE_NAME, (event) => callback(event.detail));
      },
      /**
       * Sets the active tab based on the given key.
       * @param {string} key - The value attribute of the tab to activate.
       */
      setActiveTab(key) {
        control.selected = key;
      },
      /**
       * Gets the list of tab controls.
       * @returns {HTMLElement[]} - An array of tab control elements.
       */
      get tabs() {
        return tabs;
      },
      /**
       * Gets the list of tab content elements.
       * @returns {HTMLElement[]} - An array of tab content elements.
       */
      get contentList() {
        return contentList;
      },
    };
  }
}

export const tabsService = new TabsService();
