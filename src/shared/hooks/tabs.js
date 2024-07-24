// TODO: Have to be refactored with a common login at the recommendation slider and contact-cta
export function useTabs(tabsContainer, activeClass, defaultClass) {
  const tabs = {};
  let currentTab = null;

  const tabsContent = tabsContainer.querySelectorAll('[data-tab]');
  const tabButtons = tabsContainer.querySelectorAll('[data-tab-button]');

  tabsContent.forEach((element) => {
    const key = element.dataset.tab;
    const isActive = element.dataset.tabState === 'open';

    tabs[key] = {
      key,
      element,
      isActive,
    };

    if (isActive) {
      currentTab = tabs[key];
    }
  });

  tabButtons.forEach((element) => {
    element.addEventListener('mousedown', (event) => {
      if (activeClass) {
        const button = tabsContainer.querySelector(`[data-tab-button].${activeClass}`);

        button?.classList.remove(activeClass);
        button?.classList.toggle(defaultClass, !!defaultClass);
      }

      clickHandler(event, tabs);
    });
  });

  function clickHandler(event, tabs) {
    const button = event.target.closest('[data-tab-button]');

    if (!button) return;

    const tabKey = button.dataset.tabButton;

    if (tabKey === currentTab.key) {
      return;
    }

    currentTab.isActive = false;
    currentTab.element.style.display = 'none';

    button.classList.toggle(defaultClass, !!defaultClass);
    button.classList.toggle(activeClass, !!activeClass);

    tabs[tabKey].isActive = true;
    tabs[tabKey].element.style = null;

    currentTab = tabs[tabKey];
  }
}
