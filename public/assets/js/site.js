/* Shared site behaviour. Page-specific scripts (carousel controls, contact form) arrive in later stages. */
(function () {
  'use strict';

  document.documentElement.classList.add('js');

  var items = document.querySelectorAll('[data-reveal]');
  if (!items.length) { return; }

  function revealAll() {
    items.forEach(function (el) { el.classList.add('is-revealed'); });
  }

  var reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  // Without IntersectionObserver, or with reduced motion, show everything immediately.
  if (reduceMotion || !('IntersectionObserver' in window)) {
    revealAll();
    return;
  }

  try {
    var observer = new IntersectionObserver(function (entries, obs) {
      entries.forEach(function (entry) {
        // Also reveal items the user has already scrolled past (jump links, fast scrolling, restored scroll).
        if (entry.isIntersecting || entry.boundingClientRect.top < 0) {
          entry.target.classList.add('is-revealed');
          obs.unobserve(entry.target);
        }
      });
    }, { rootMargin: '0px 0px -8% 0px', threshold: 0.05 });

    items.forEach(function (el) { observer.observe(el); });
  } catch (e) {
    // Never leave content hidden if the observer fails.
    revealAll();
  }
})();
