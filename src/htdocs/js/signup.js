'use strict';


var SignupForm = require('SignupForm'),
    SignupMap = require('map/SignupMap');

var form,
    map;

map = document.querySelector('.map');
if (map) {
  SignupMap({
    el: map
  });
}

form = document.querySelector('form');
if (form) {
  SignupForm({
    el: form
  });
}
