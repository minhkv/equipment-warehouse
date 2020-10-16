require('./bootstrap');

window.Vue = require('vue');
import VueHtmlToPaper from 'vue-html-to-paper';

import moment from 'moment';

Vue.filter('formatDate', function (value) {
    if (!value) return ''
    return moment(value).format("DD/MM/YYYY")
});
Vue.filter('formatDateTime', function (value) {
    if (!value) return ''
    return moment(value).format("DD/MM/YYYY, LT")
});

Vue.filter('formatBoolean', function (value) {
    if (value) return 'Có';
    return 'Không';
});
Vue.filter('formatPrice', function(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') + "đ";
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

const options = {
    name: '_blank',
    specs: [
        'fullscreen=yes',
        'titlebar=yes',
        'scrollbars=yes'
    ],
    styles: [
        'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css',
        'https://unpkg.com/kidlat-css/css/kidlat.css'
    ]
};

Vue.use(VueHtmlToPaper, options);
Vue.component('category-form',require('./components/category/category-form.vue').default);
Vue.component('category',require('./components/category/category.vue').default);
Vue.component('equipment-templates',require('./components/equipment/equipment-templates.vue').default);
Vue.component('equipment-lost',require('./components/equipment/equipment-lost.vue').default);
Vue.component('equipment-detail', require('./components/equipment/equipment-detail.vue').default);
Vue.component('equipment-status',require('./components/equipment/equipment-status.vue').default);
Vue.component('equipment-form',require('./components/equipment/equipment-form.vue').default);
Vue.component('equipment-condition',require('./components/equipment/equipment-condition.vue').default);
Vue.component('equipment-info',require('./components/equipment/equipment-info.vue').default);
Vue.component('equipment-status-popover',require('./components/equipment/equipment-status-popover.vue').default);
Vue.component('equipment-create',require('./components/equipment/equipment-create.vue').default);
Vue.component('equipment-template-form',require('./components/equipment/equipment-template-form.vue').default);
Vue.component('template-form',require('./components/equipment/equipment-template-form.vue').default);
Vue.component('multi-step-form',require('./components/multi-step-form.vue').default);
Vue.component('table-select-equipment',require('./components/table/table-select-equipment.vue').default);
Vue.component('table-verify-equipment',require('./components/table/table-verify-equipment.vue').default);
Vue.component('table-component',require('./components/table/table-component.vue').default);
Vue.component('table-history',require('./components/table/table-history.vue').default);
Vue.component('table-select-template',require('./components/table/table-select-template.vue').default);
Vue.component('table-display-info',require('./components/table/table-display-info.vue').default);
Vue.component('table-input-template',require('./components/table/table-input-template.vue').default);
Vue.component('order-detail',require('./components/order/order-detail.vue').default);
Vue.component('order',require('./components/order/order.vue').default);
Vue.component('order-status',require('./components/order/order-status.vue').default);
Vue.component('order-title',require('./components/order/order-title.vue').default);
Vue.component('supplier-name',require('./components/supplier/supplier-name.vue').default);
Vue.component('supplier',require('./components/supplier/supplier.vue').default);
Vue.component('supplier-form',require('./components/supplier/supplier-form.vue').default);
Vue.component('selection-filter',require('./components/select/selection-filter.vue').default);
Vue.component('select-condition',require('./components/select/select-condition.vue').default);
Vue.component('selector',require('./components/select/selector.vue').default);
Vue.component('create-input-order',require('./components/input-order/create-input-order.vue').default);
Vue.component('input-order',require('./components/input-order/input-order.vue').default);
Vue.component('input-order-detail',require('./components/input-order/input-order-detail.vue').default);
Vue.component('autocomplete-input',require('./components/input/autocomplete-input.vue').default);
Vue.component('search-input',require('./components/input/search-input.vue').default);
Vue.component('number-input',require('./components/input/number-input.vue').default);
Vue.component('pagination',require('./components/pagination.vue').default);
Vue.component('modal-component',require('./components/modal-component.vue').default);
Vue.component('info-status',require('./components/info-status.vue').default);
Vue.component('print-order',require('./components/print-order.vue').default);
Vue.component('user-index',require('./components/user/user-index.vue').default);
Vue.component('user-form',require('./components/user/user-form.vue').default);
Vue.component('department-index',require('./components/department/department-index.vue').default);
Vue.component('department-form',require('./components/department/department-form.vue').default);
Vue.component('test',require('./components/test.vue').default);

var app = new Vue({
    el: '#app'
});