import { html } from '@shared/services/dom-services';

class FormValidatorService {
  #VALIDATION_TYPE_ATTRIBUTE = 'data-validation-type';
  #ERROR_MESSAGE_ATTRIBUTE = 'data-error-message';
  #ERROR_CLASS_ATTRIBUTE = 'data-error-class';

  validateInput(input) {
    const parentWrap = input.closest(`[${this.#VALIDATION_TYPE_ATTRIBUTE}]`);
    const validationType = parentWrap.getAttribute(this.#VALIDATION_TYPE_ATTRIBUTE);
    const errorMessage = parentWrap.getAttribute(this.#ERROR_MESSAGE_ATTRIBUTE);
    const errorClass = parentWrap.getAttribute(this.#ERROR_CLASS_ATTRIBUTE);
    let isValid = true;

    if (validationType === 'letters') {
      if (!/^[a-zA-Z\s]+$/.test(input.value)) {
        isValid = false;
      }
    }

    if (validationType === 'file-selected') {
      if (!(input.files && input.files.length > 0)) {
        isValid = false;

        setTimeout(() => {
          this.clearErrorCF7(input);
        }, 0);
      }
    }

    if (isValid) {
      this.clearError(input);
      this.removeErrorClass(input, errorClass);
    } else {
      this.showError(input, errorMessage);
      this.addErrorClass(input, errorClass);
    }

    return isValid;
  }

  validateForm(form, event) {
    const inputs = form.querySelectorAll(`[${this.#VALIDATION_TYPE_ATTRIBUTE}] input, [${this.#VALIDATION_TYPE_ATTRIBUTE}] textarea`);
    let isValid = true;

    inputs.forEach(input => {
      const parentWrap = input.closest(`[${this.#VALIDATION_TYPE_ATTRIBUTE}]`);
      const validationType = parentWrap.getAttribute(this.#VALIDATION_TYPE_ATTRIBUTE);
      const errorMessage = parentWrap.getAttribute(this.#ERROR_MESSAGE_ATTRIBUTE);
      const errorClass = parentWrap.getAttribute(this.#ERROR_CLASS_ATTRIBUTE);

      if (!this.validateInput(input, validationType, errorMessage, errorClass)) {
        isValid = false;
      }
    });

    if (!isValid) {
      event.preventDefault();
    }

    return isValid;
  }

  showError(field, message) {
    this.clearError(field);
    const errorContainer = html`<span class="error-message">
      ${message}
    </span>`;

    field.parentNode.appendChild(errorContainer);
  }

  clearError(field) {
    const errorContainer = field.parentNode.querySelector('.error-message');
    if (errorContainer) {
      errorContainer.remove();
    }
  }

  clearErrorCF7(field) {
    const errorContainer = field.parentNode.querySelector('.wpcf7-not-valid-tip');
    if (errorContainer) {
      errorContainer.remove();
    }
  }

  addErrorClass(field, errorClass) {
    this.removeErrorClass(field, errorClass);
    if (errorClass) {
      field.classList.add(errorClass);
    }
  }

  removeErrorClass(field, errorClass) {
    if (errorClass) {
      field.classList.remove(errorClass);
    }
  }
}

export const formValidatorService = new FormValidatorService();
