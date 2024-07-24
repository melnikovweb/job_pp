/**
 * Registers a callback function to be executed once the DOM is fully loaded and parsed.
 * This ensures that the DOM is ready before the callback function attempts to access any elements.
 *
 * @param {Function} callback - The callback function to execute when the DOMContentLoaded event is fired.
 */
function onDomReady(callback) {
  document.addEventListener('DOMContentLoaded', callback);
}

/**
 * A tagged template literal function for creating an HTML element from a template string.
 * This function allows for cleaner HTML markup within JavaScript code, utilizing template literals for dynamic content.
 * Note: Ensure that any user-generated content passed to this function is properly sanitized to prevent XSS vulnerabilities.
 *
 * @param {TemplateStringsArray} strings - The template strings array, containing the static parts of the template literal.
 * @param {...any} values - The dynamic values to be interpolated within the template.
 * @returns {ChildNode} The first child node of the created template element, effectively turning the template string into a DOM element.
 */
function html(strings, ...values) {
  const template = document.createElement('template');
  let htmlString = strings[0];

  values.forEach((value, i) => {
    htmlString += `${value}${strings[i + 1]}`;
  });

  template.innerHTML = htmlString.trim();
  return template.content.firstChild;
}

export { onDomReady, html };
