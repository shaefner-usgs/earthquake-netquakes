'use strict';


/**
 * Add behavior to Signup form
 */
var SignupForm = function (options) {
  var _this,
      _initialize,

      _el,

      _addListeners,
      _submitForm,
      _toggleFields,
      _toggleForm;

  _this = {};

  _initialize = function (options) {
    options = options || {};
    _el = options.el || document.createElement('div');

    _addListeners();
  };

  /**
   * Add event listeners
   */
  _addListeners = function () {
    var button,
        controller;

    button = document.querySelector('#volunteer button');
    button.addEventListener('click', _submitForm);

    controller = document.getElementById('toggle');
    controller.addEventListener('click', _toggleForm);
  };

  /**
   * Add 'submitted' class when form submitted
   */
  _submitForm = function () {
    _el.classList.add('submitted');
  };

  /**
   * Toggle the disabled attr for form fields in passed Elem
   *
   * @param el {Element}
   */
  _toggleFields = function (el) {
    var i,
        field,
        fields;

    fields = el.querySelectorAll('input, select');

    for (i = 0; i < fields.length; i ++) {
      field = fields[i];
      if (field.hasAttribute('disabled')) {
        field.removeAttribute('disabled');
      } else {
        field.setAttribute('disabled', 'disabled');
      }
    }
  };

  /**
   * Toggle the display of the optional portion of the signup form
   */
  _toggleForm = function () {
    var el,
        i,
        columns;

    el = _el.querySelector('.mailing');
    el.classList.toggle('disabled');

    columns = _el.querySelectorAll('.column');

    for (i = 0; i < columns.length; i ++) {
      columns[i].classList.toggle('one-of-two');
      columns[i].classList.toggle('one-of-three');
    }

    _toggleFields(el);
  };

  _initialize(options);
  options = null;
  return _this;
};


module.exports = SignupForm;
