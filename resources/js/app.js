require('./bootstrap');

window.Vue = require('vue');

import moment from 'moment';
moment().format();

Vue.filter('formatDate', function (value) {
    if (!value) return ''
    return moment(value).format("DD/MM/YYYY, LT")
});

Vue.filter('formatDateDatabase', function(value) {
    if (!value) return ''
    return moment(value).format("DD/MM/YYYY, LT")
});

Vue.filter('formatBoolean', function (value) {
    if (value) return 'Có';
    return 'Không';
});
  

Vue.component('testcomponent',require('../components/test.vue').default);
Vue.component('multi-step-form',require('../components/multi-step-form.vue').default);
Vue.component('equipment-templates',require('../components/equipment-templates.vue').default);
Vue.component('equipment-lost',require('../components/equipment-lost.vue').default);
Vue.component('order-detail',require('../components/order-detail.vue').default);
Vue.component('order',require('../components/order.vue').default);

var app = new Vue({
    el: '#app'
});