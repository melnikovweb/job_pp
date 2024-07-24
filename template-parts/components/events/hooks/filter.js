import Choices from 'choices.js';
import { html } from '@shared/services/dom-services';
import { choicesService } from '@shared/services/choices-service';

export function useFilter() {
  const options = {
    removeItemButton: true,
    itemSelectText: '',
  };

  return {
    create(selector) {
      const control = new Choices(selector, {
        ...options,
        callbackOnCreateTemplates() {
          return {
            item: (...args) => {
              const item = Object.assign(Choices.defaults.templates.item.call(this, ...args), {
                className: 'flex items-center gap-2 rounded-full bg-blue-600 px-2 py-1 text-white font-b3',
              });

              const removeButton = Object.assign(item.querySelector('button'), {
                className: 'flex relative z-10 items-center text-white',
                innerHTML: '',
              });

              removeButton.append(html`
                <svg
                  class="pointer-events-none"
                  width="12"
                  height="12"
                  viewBox="0 0 12 12"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg">
                  <g id="Pircture">
                    <path
                      id="Union"
                      d="M2.25418 1.52787C2.05361 1.3273 1.72843 1.3273 1.52787 1.52787C1.3273 1.72843 1.3273 2.05361 1.52787 2.25418L5.27335 5.99966L1.52787 9.74515C1.3273 9.94571 1.3273 10.2709 1.52787 10.4715C1.72843 10.672 2.05361 10.672 2.25418 10.4715L5.99966 6.72597L9.74515 10.4715C9.94571 10.672 10.2709 10.672 10.4715 10.4715C10.672 10.2709 10.672 9.94571 10.4715 9.74515L6.72597 5.99966L10.4715 2.25418C10.672 2.05361 10.672 1.72843 10.4715 1.52787C10.2709 1.3273 9.94571 1.3273 9.74515 1.52787L5.99966 5.27335L2.25418 1.52787Z"
                      fill="currentcolor" />
                  </g>
                </svg>
              `);

              return item;
            },
          };
        },
      });

      choicesService.addDropdownIcon(control);

      const onChange = (callback) => {
        control.passedElement.element.addEventListener('change', () => {
          const value = control.getValue(true);

          callback(value);
        });
      };

      return {
        control,
        onChange,
        getValue: control.getValue.bind(control),
      };
    },
  };
}
