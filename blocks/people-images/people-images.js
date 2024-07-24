import Swiper from 'swiper/bundle';

const createSwiperInstance = () =>
  new Swiper('.people-images-slider', {
    slidesPerView: 1,
    spaceBetween: 16,
    navigation: {
      nextEl: '[data-navigation="next"]',
      prevEl: '[data-navigation="prev"]',
    },
  });

let swiperInstance = null;
const media = window.matchMedia('(max-width: 768px)');

const onMediaChange = () => {
  const isMobile = media.matches;
  if (isMobile && !swiperInstance) {
    swiperInstance = createSwiperInstance();
    return;
  }
  if (!swiperInstance) {
    return;
  }
  swiperInstance.destroy();
  swiperInstance = null;
};
onMediaChange();
media.addEventListener('change', onMediaChange);
