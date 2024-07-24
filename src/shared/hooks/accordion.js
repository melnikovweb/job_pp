export function useAccordion(accordionContainer, activeClass = '', defaultClass = '', defaultActiveItem = 0) {
  const items = {};

  accordionContainer.querySelectorAll('[data-accordion-content]').forEach((element, index) => {
    items[element.dataset.accordionContent] = {
      element,
      isActive: index === defaultActiveItem,
      elementHeight: element.offsetHeight,
    };

    if (index === defaultActiveItem) {
      element.parentNode.style.height = element.offsetHeight + 'px';
      return;
    }

    element.parentNode.style.height = 0;
  });

  accordionContainer.querySelectorAll('[data-accordion-button]').forEach((element) => {
    element.addEventListener('click', (event) => {
      if (activeClass) {
        const button = accordionContainer.querySelector(`[data-tab-button].${activeClass}`);
        button?.classList.remove(activeClass);
        !!defaultClass && button?.classList.add(defaultClass);
      }
      clickHandler(event, items);
    });
  });

  function clickHandler(event, items) {
    const button = event.target.closest('[data-accordion-button]');
    if (!button) return;

    let activeItem = null;

    const keys = Object.keys(items);
    for (let i = 0; i < keys.length; ++i) {
      if (items[keys[i]].isActive) {
        activeItem = items[keys[i]];
        break;
      }
    }

    button.classList.toggle(defaultClass, !!defaultClass);
    button.classList.toggle(activeClass, !!activeClass);

    const accordionButton = items[button.dataset.accordionButton];

    accordionButton.element.parentNode.style.height = `${accordionButton.elementHeight}px`;
    accordionButton.isActive = true;

    if (activeItem) {
      console.log(activeItem);
      activeItem.element.parentNode.style.height = 0;
      activeItem.isActive = false;
    }
  }
}
