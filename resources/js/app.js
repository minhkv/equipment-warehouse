require('./bootstrap');

window.Vue = require('vue');

Vue.component('testcomponent',require('../components/test.vue').default);
Vue.component('multi-step-form',require('../components/multi-step-form.vue').default);

const app = new Vue({
    el: '#app'
});