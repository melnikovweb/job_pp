import { html } from '@shared/services/dom-services';
import { useFollowsAnchor } from '@shared/hooks/folows-anchor';
import Choices from 'choices.js';

useFollowsAnchor({
  navigation: document.querySelector('[data-follows="navigation"]'),
});

// TODO move in services
const select = document.querySelector('[data-type="cat-select"]');
if (select) {
  const choices = new Choices(select, {
    removeItemButton: false,
    allowHTML: true,
    searchEnabled: false,
    searchChoices: false,
    itemSelectText: '',
  });

  if (choices) {
    select.addEventListener('change', (event) => {
      const url = event.target.value;
      setTimeout(function () {
        window.open(url, '_self');
      }, 0);
    });
  }

  const containerInnerElement = choices.containerInner.element;
  const iconArrow = html`<span data-icon="choices">
    <svg
      xmlns="http://www.w3.org/2000/svg"
      width="24"
      height="24"
      viewBox="0 0 24 24"
      fill="none">
      <path
        d="M6 10L12 16L18 10"
        stroke="#0A101E"
        stroke-width="1.5"
        stroke-linecap="round"
        stroke-linejoin="round" />
    </svg>
  </span>`;

  containerInnerElement.insertAdjacentElement('beforeend', iconArrow);
}
