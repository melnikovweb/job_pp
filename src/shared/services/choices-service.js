import { html } from './dom-services';

class ChoicesService {
  addDropdownIcon(instance, element = null) {
    const iconElement =
      element ??
      html`
        <div class="absolute right-4 top-0 flex h-full items-center sm:right-6">
          <svg
            class="size-6 transition [&:where(.is-open_*)]:rotate-180"
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none">
            <path
              d="M6 10L12 16L18 10"
              stroke="currentcolor"
              stroke-width="1.5"
              stroke-linecap="round"
              stroke-linejoin="round" />
          </svg>
        </div>
      `;

    const innerElement = instance.containerInner.element;

    innerElement.classList.add('relative', 'pr-10', 'sm:pr-16');

    innerElement.append(iconElement);
  }
}

export const choicesService = new ChoicesService();
