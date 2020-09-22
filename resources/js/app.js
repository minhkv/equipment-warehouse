require('./bootstrap');

window.Vue = require('vue');

import moment from 'moment';

Vue.filter('formatDate', function (value) {
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
Vue.filter('formatInfoStatus', function(status){
    switch(status) {
        case 0:
            return 'Thất lạc';
        case 1:
            return 'Đã nhận';
        case 2:
            return 'Đang cho mượn';
    }
});
Vue.filter('formatOrderStatus', function(status){
    switch(status) {
        case -1:
            return 'Từ chối';
        case 0:
            return 'Đang chờ';
        case 1:
            return 'Chấp nhận';
        case 2:
            return 'Xuất đồ';
        case 3:
            return 'Kiểm đồ';
        case 4:
            return 'Hoàn tất';
    }
});
Vue.filter('formatEquipmentCondition', function(status){
    if(status == 0) return "Lỗi";
    if(status == 1) return "Bình thường";
    if(status >= 2) return "Tốt";
});
Vue.filter('formatEquipmentPrice', function(price){
    return new Intl.NumberFormat().format(price) + 'đ';
});



Vue.component('multi-step-form',require('./components/multi-step-form.vue').default);
Vue.component('equipment-templates',require('./components/equipment-templates.vue').default);
Vue.component('equipment-lost',require('./components/equipment-lost.vue').default);
Vue.component('equipment-detail', require('./components/equipment-detail.vue').default);
Vue.component('order-detail',require('./components/order-detail.vue').default);
Vue.component('order',require('./components/order.vue').default);
Vue.component('equipment-status',require('./components/equipment-status.vue').default);
Vue.component('equipment-form',require('./components/equipment-form.vue').default);
Vue.component('equipment-condition',require('./components/equipment-condition.vue').default);
Vue.component('order-status',require('./components/order-status.vue').default);
Vue.component('order-title',require('./components/order-title.vue').default);
Vue.component('supplier-name',require('./components/supplier-name.vue').default);
Vue.component('autocomplete-input',require('./components/autocomplete-input.vue').default);
Vue.component('search-input',require('./components/search-input.vue').default);
Vue.component('pagination',require('./components/pagination.vue').default);
Vue.component('selection-filter',require('./components/selection-filter.vue').default);
Vue.component('select-condition',require('./components/select-condition.vue').default);
Vue.component('modal-component',require('./components/modal-component.vue').default);
Vue.component('info-status',require('./components/info-status.vue').default);
Vue.component('table-component',require('./components/table-component.vue').default);
Vue.component('table-history',require('./components/table-history.vue').default);
Vue.component('equipment-info',require('./components/equipment-info.vue').default);
Vue.component('equipment-status-popover',require('./components/equipment-status-popover.vue').default);
Vue.component('table-select-template',require('./components/table-select-template.vue').default);
Vue.component('table-select-equipment',require('./components/table-select-equipment.vue').default);
Vue.component('table-verify-equipment',require('./components/table-verify-equipment.vue').default);
Vue.component('table-display-info',require('./components/table-display-info.vue').default);
Vue.component('supplier',require('./components/supplier.vue').default);
Vue.component('supplier-form',require('./components/supplier-form.vue').default);
Vue.component('selector',require('./components/selector.vue').default);
Vue.component('test',require('./components/test.vue').default);

var app = new Vue({
    el: '#app'
});