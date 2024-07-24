import { formValidatorService } from '@shared/services/form-validator-service';

export function useFormValidator({ formSelector }) {
  const validatedWrapInputSelector = '[data-validation-type]';
  const forms = document.querySelectorAll(formSelector);

  forms.forEach(form => {
    const labels = form.querySelectorAll(validatedWrapInputSelector);
    labels.forEach(label => {
      const input = label.querySelector('input, textarea');
      if (input) {
        input.addEventListener('input', () => formValidatorService.validateInput(input));
      }
    });

    form.addEventListener('submit', (event) => formValidatorService.validateForm(form, event));
    form.addEventListener('wpcf7submit', (event) => {
      const invalidFields = event.detail.apiResponse.invalid_fields;
      invalidFields.forEach(({ field }) => {
        const fieldElement = document.querySelector(`[name="${field}"]`);
        if (fieldElement) {
          formValidatorService.clearError(fieldElement);
        }
      });
    });
  });
}
