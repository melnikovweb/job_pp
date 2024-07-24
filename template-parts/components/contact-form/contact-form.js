import { useFormValidator } from '@shared/hooks/form-validator';
import { useCountrySelect } from '@shared/hooks/country-select';

window.wpcf7.cached = 0;

useFormValidator({ formSelector: '.wpcf7-form' });
const countrySelect = useCountrySelect();

const WPData = window.SECRET_contact_form;

const countrySelectElements = document.querySelectorAll('[data-name="country-select"] select');
const inputFileElements = document.querySelectorAll('.wpcf7 [type="file"]');

inputFileElements.forEach((element) => {
  const elementText = element.closest('label').querySelector('.file-name');

  element.addEventListener('change', (event) => {
    const file = event.target.files[0];
    elementText.textContent = file?.name || '';
  });
});

document.addEventListener(
  'wpcf7mailsent',
  (event) => {
    inputFileElements.forEach((element) => {
      const elementText = element.closest('label').querySelector('.file-name');
      elementText.textContent = '';
    });
  },
  false,
);

countrySelectElements.forEach((element) => {
  countrySelect.create(element, {
    placeholder: WPData.countriesPlaceholder,
    choices: WPData.allowedCountries.map(({ cca2, shortName, flag, regionName, fullName }) => ({
      value: cca2,
      label: shortName,
      selected: false,
      disabled: false,
      customProperties: {
        flag,
        regionName,
        fullName,
      },
    })),
  });
});
