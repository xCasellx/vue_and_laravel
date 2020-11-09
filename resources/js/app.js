require('./bootstrap');

window.Vue = require('vue');

import 'bootstrap/dist/css/bootstrap.css'
import BootstrapVue from 'bootstrap-vue'
import BootstrapVueIcons from 'bootstrap-vue'

Vue.use(BootstrapVue)
Vue.use(BootstrapVueIcons)

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('user-update', require('./components/UserUpdate').default);
Vue.component('update-password', require('./components/UpdatePassword').default);
Vue.component('update-image', require('./components/UpdateImage').default);
Vue.component('nav-user-data', require('./components/NavUserData').default);
Vue.component('location-select', require('./components/LocationSelect').default);
Vue.component('user-cabinet', require('./components/UserCabinet').default);
Vue.component('comments' , require("./components/Comments").default);
Vue.component('account' , require("./components/Account").default);

const app = new Vue({
    el: '#app',

});


