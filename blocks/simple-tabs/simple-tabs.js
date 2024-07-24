import { classesService } from '@services/classes-service';

const tabsContainer = document.querySelector('[data-id="tabs"]');
const contentContaner = document.querySelector('[data-id="content"]');
const timestampContainer = document.querySelector('[data-id="timestamp"]');

const tabs = [...tabsContainer.children];
const contentList = [...contentContaner.children];
const timestampList = [...timestampContainer.children];

tabsContainer.addEventListener('click', ({ target }) => {
  const currentValue = target.dataset.value;

  if (!currentValue) {
    return;
  }

  tabs.forEach((tab) => {
    const value = tab.dataset.value;

    classesService.toggleList(tab, tab.dataset.activeClasses, value === currentValue);
    classesService.toggleList(tab, tab.dataset.defaultClasses, value !== currentValue);
  });

  timestampList.forEach((timestamp) => {
    const value = timestamp.dataset.value;

    timestamp.classList.toggle('block', currentValue === value);
    timestamp.classList.toggle('hidden', currentValue !== value);
  });

  contentList.forEach((content) => {
    const value = content.dataset.value;

    content.classList.toggle('grid', currentValue === value);
    content.classList.toggle('hidden', currentValue !== value);
  });
});
