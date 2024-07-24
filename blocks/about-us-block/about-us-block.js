const showMoreButton = document.querySelector('[data-action="show-more"]');
const hiddenPersonBlocks = document.querySelectorAll('.about-us-block .hidden');

showMoreButton?.addEventListener('click', () => {
  hiddenPersonBlocks.forEach((block) => block.classList.remove('hidden'));
  showMoreButton.classList.add('hidden');
});
