require('./bootstrap');

window.Vue = require('vue');

window.toastr = require('toastr');

window.Swal = require('sweetalert2');

require('./routes');

const app = new Vue({
    el: '#app',
});
