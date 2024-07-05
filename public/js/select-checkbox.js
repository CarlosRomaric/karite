/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************************!*\
  !*** ./resources/js/utilities/select-checkbox.js ***!
  \***************************************************/
var allCheckbox = document.querySelector("#select-all-checkbox");
allCheckbox.addEventListener('change', function () {
  var checkboxes = document.querySelectorAll('input[type="checkbox"]');
  for (var i = 0; i < checkboxes.length; i++) {
    if (checkboxes[i] !== allCheckbox) {
      checkboxes[i].checked = allCheckbox.checked;
    }
  }
});
/******/ })()
;