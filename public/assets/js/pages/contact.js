/* Contact page: move focus to the result message (errors or demo notice) so screen-reader and keyboard users land on it. */
(function () {
  'use strict';
  var target = document.querySelector('[data-focus-on-load]');
  if (target) { target.focus(); }
})();
