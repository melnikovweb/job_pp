import { useScrollObserver } from './scroll-observer';

export function useFollowsAnchor({ navigation }) {
  const scrollObserver = useScrollObserver();
  const ACTIVE_CLASS = 'active';

  const anchorsMap = {};
  const anchors = Array.from(navigation.querySelectorAll('[href^="#"]'), (anchor, index) => {
    const { hash } = new URL(anchor.href);

    const content = document.querySelector(hash);

    const value = {
      target: anchor,
      index,
      hash,
      content,
    };

    anchorsMap[hash.slice(1)] = value;

    if (!content) {
      console.warn(`Headline with has the anchor ${hash} does not exist.`);
    }

    return value;
  });

  let currentAnchorKey = null;

  scrollObserver.subscribe(() => {
    anchors.forEach(({ target, content, index }) => {
      if (!content) {
        return;
      }

      const contentRect = content.getBoundingClientRect();
      const threshold = window.innerHeight / 3;
      const isIntersected = document.body.scrollTop + threshold > contentRect.top;

      if (isIntersected) {
        currentAnchorKey = content.id;
      } else if (!index) {
        currentAnchorKey = null;
        target.classList.remove(ACTIVE_CLASS);
      }
    });

    if (!currentAnchorKey) {
      return;
    }

    const currentAnchor = anchorsMap[currentAnchorKey];

    if (currentAnchor.target.classList.contains(ACTIVE_CLASS)) {
      return;
    }

    anchors.forEach(({ target }) => target.classList.remove(ACTIVE_CLASS));
    currentAnchor.target.classList.add(ACTIVE_CLASS);
  });
}
