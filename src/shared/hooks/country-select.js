import { html } from '@shared/services/dom-services';
import Choices from 'choices.js';

const DEFAULT_OPTIONS = {
  placeholder: '',
  choices: [],
};

export function useCountrySelect() {
  return {
    create(element, { placeholder, choices } = DEFAULT_OPTIONS) {
      const control = new Choices(element, {
        placeholderValue: placeholder,
        choices,
        callbackOnCreateTemplates() {
          return {
            item: ({ classNames }, data) => {
              const isSelectedElement = data.id !== 1;
              const highlightedClasses = data.highlighted ? classNames.highlightedState : classNames.itemSelectable;

              const element = isSelectedElement
                ? html`
                    <div
                      class="${highlightedClasses} flex items-center gap-2 text-gray font-b2"
                      ${data.active ? 'aria-selected="true"' : ''}
                      ${data.disabled ? 'aria-disabled="true"' : ''}
                      data-item
                      data-id="${data.id}"
                      data-value="${data.value}">
                      <div class="size-6 overflow-hidden rounded-full">
                        <img
                          class="size-full object-cover"
                          src="${data.customProperties.flag}" />
                      </div>

                      ${data.label}
                    </div>
                  `
                : html`
                    <div
                      class="${highlightedClasses} flex items-center gap-2 text-gray font-b2"
                      ${data.active ? 'aria-selected="true"' : ''}
                      ${data.disabled ? 'aria-disabled="true"' : ''}
                      data-item
                      data-id="${data.id}"
                      data-value="${data.value}">
                      ${data.label}
                    </div>
                  `;

              return element;
            },
            choice: (_, data) => {
              const statusClasses = data.disabled ? 'disabled' : 'selectable';
              const statusAttributes = data.disabled
                ? 'data-choice-disabled aria-disabled="true"'
                : 'data-choice-selectable';

              const groupIdAttributes = data.groupId > 0 ? 'role="treeitem"' : 'role="option"';

              return html`
                <div
                  class="${statusClasses} flex items-center gap-2 px-4 py-3 text-gray font-b1"
                  ${statusAttributes}
                  ${groupIdAttributes}
                  data-choice
                  data-id="${data.id}"
                  data-value="${data.value}">
                  <div class="size-6 overflow-hidden rounded-full">
                    <img
                      class="size-full object-cover"
                      src="${data.customProperties.flag}" />
                  </div>

                  ${data.label}
                </div>
              `;
            },
          };
        },
      });

      const inputElement = control.input.element;
      const parentElement = inputElement.parentElement;

      inputElement.classList = '[all:unset] placeholder-gray-600 text-gray outline-transparent w-full border-none';

      const inputWrapper = html`<label class="!flex gap-2 border border-solid border-b-gray-200 p-4">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 24 25"
          fill="none"
          class="size-6">
          <path
            d="M20.0001 20.5L16.1334 16.6333M18.2223 11.6111C18.2223 15.5385 15.0385 18.7223 11.1111 18.7223C7.18377 18.7223 4 15.5385 4 11.6111C4 7.68377 7.18377 4.5 11.1111 4.5C15.0385 4.5 18.2223 7.68377 18.2223 11.6111Z"
            class="stroke-gray"
            stroke-width="1.5"
            stroke-linecap="round"
            stroke-linejoin="round" />
        </svg>
      </label>`;

      inputWrapper.appendChild(inputElement);
      parentElement.insertAdjacentElement('afterbegin', inputWrapper);

      return control;
    },
  };
}
