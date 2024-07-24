import { useTabs } from '@shared/hooks/tabs';
import Swiper from 'swiper/bundle';
const tabsContainers = document.querySelectorAll('[data-tabs]');
tabsContainers.forEach((tabsContainer) => useTabs(tabsContainer, 'bg-yellow', 'bg-grey-200'));
const sliderElements = document.querySelectorAll('[data-slider-3]');
const initSlider = (element) => {
  if (!element) {
    throw new Error("Element can't be null");
  }
  return new Swiper(element, {
    slidesPerView: 1,
    navigation: {
      nextEl: element.querySelector('[data-slider-arrow="next"]'),
      prevEl: element.querySelector('[data-slider-arrow="prev"]'),
    },
    breakpoints: {
      577: {
        slidesPerView: 1.78,
        spaceBetween: 32,
      },
      769: {
        slidesPerView: 2,
        spaceBetween: 32,
      },
      1025: {
        slidesPerView: 3,
        spaceBetween: 32,
      },
      1601: {
        slidesPerView: 3,
        spaceBetween: 40,
      },
    },
  });
};
sliderElements.forEach((element) => {
  initSlider(element);
});
