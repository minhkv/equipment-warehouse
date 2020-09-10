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
Vue.filter('formatPrice', function(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') + "vnd";
});
Vue.filter('formatEquipmentStatus', function(status){
    switch(status) {
        case 0:
            return 'Thất lạc';
        case 1:
            return 'Sẵn sàng';
        case 2:
            return 'Đang cho mượn';
    }
});
Vue.filter('formatEquipmentCondition', function(status){
    if(status == 0) return "Lỗi";
    if(status == 1) return "Bình thường";
    if(status >= 2) return "Tốt";
});

Vue.component('testcomponent',require('../components/test.vue').default);
Vue.component('multi-step-form',require('../components/multi-step-form.vue').default);
Vue.component('equipment-templates',require('../components/equipment-templates.vue').default);
Vue.component('equipment-lost',require('../components/equipment-lost.vue').default);
Vue.component('equipment-detail', require('../components/equipment-detail.vue').default);
Vue.component('order-detail',require('../components/order-detail.vue').default);
Vue.component('order',require('../components/order.vue').default);
Vue.component('equipment-status',require('../components/equipment-status.vue').default);
Vue.component('equipment-form',require('../components/equipment-form.vue').default);
Vue.component('equipment-condition',require('../components/equipment-condition.vue').default);
Vue.component('test',require('../components/test.vue').default);

var app = new Vue({
    el: '#app'
});