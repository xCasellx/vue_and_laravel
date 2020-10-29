require('./bootstrap');

window.Vue = require('vue');


Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('location-select', require('./components/LocationSelect').default);
Vue.component('user-cabinet', require('./components/UserCabinet').default);

const app = new Vue({
    el: '#app',
});
