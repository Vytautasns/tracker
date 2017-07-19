import Vue from 'vue';
import UIkit from 'uikit';
import moment from 'moment';
import Highcharts from 'highcharts';
import Hammer from 'hammerjs';

window.Vue = Vue;
window.UIkit = UIkit;
window.moment = moment;
window.Highcharts = Highcharts;
window.Hammer = Hammer;



// window._ = require('lodash');

require('uikit/dist/js/uikit-icons.min.js');


// Jquery

try {
    window.$ = window.jQuery = require('jquery');
} catch (e) {}


// Axios

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
