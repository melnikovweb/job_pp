export function useScrollObserver() {
  const DIRECTION = {
    UP: 'UP',
    DOWN: 'DOWN',
  };

  let subscribers = [];
  let lastScrollPosition = window.scrollY;

  let state = {
    direction: DIRECTION.DOWN,
    position: lastScrollPosition,
  };

  const subscribe = (callback) => {
    subscribers.push(callback);

    return () => {
      subscribers = subscribers.filter((subscriber) => subscriber !== callback);
    };
  };

  const handleScroll = () => {
    const currentScrollPosition = window.scrollY;
    const direction = lastScrollPosition < currentScrollPosition ? DIRECTION.DOWN : DIRECTION.UP;

    state = {
      direction,
      position: currentScrollPosition,
    };

    subscribers.forEach((subscriber) => subscriber(state));
    lastScrollPosition = currentScrollPosition;
  };

  window.addEventListener('scroll', handleScroll);

  return {
    subscribe,
    DIRECTION,
  };
}
