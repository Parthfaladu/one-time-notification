window._ = require('lodash');

window.$ = window.jQuery = require('jquery');
window.Popper = require('popper.js');
require('jquery-validation');
require('datatables.net');
require('./dataTables.bootstrap4.min.js');
require('./dataTables.responsive.min.js');
require('bootstrap');
require('./jquery-ui.js');
require('bootstrap4-toggle');
window.moment = require('moment');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
