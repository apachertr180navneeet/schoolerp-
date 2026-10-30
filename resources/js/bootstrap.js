import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;

window._ = require('lodash');
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
