class ClassesService {
  #getClasses(list) {
    return list.split(' ').filter(Boolean);
  }

  #isElementExist(element) {
    try {
      if (!element) {
        throw new Error(`Element ${element} doesnot exist.`);
      }

      return true;
    } catch (error) {
      console.error(error);
      return false;
    }
  }

  toggleList(element, list, value) {
    if (!this.#isElementExist(element)) return;

    const classes = this.#getClasses(list);

    classes.forEach((className) => {
      element.classList.toggle(className, value);
    });
  }

  addList(element, list) {
    if (!this.#isElementExist(element)) return;

    const classes = this.#getClasses(list);

    element.classList.add(...classes);
  }

  removeList(element, list) {
    if (!this.#isElementExist(element)) return;

    const classes = this.#getClasses(list);

    element.classList.remove(...classes);
  }
}

export const classesService = new ClassesService();
