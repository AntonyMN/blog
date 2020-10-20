require('./bootstrap');

window.Vue = require('vue');

window.toastr = require('toastr');

window.Swal = require('sweetalert2');

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('user-index', require('./components/Users/index.vue').default);


const app = new Vue({
    el: '#app',
});
