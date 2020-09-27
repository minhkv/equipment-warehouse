<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>Đơn mượn thiết bị</h2>
            </div>
        </div>
        <div class="row py-4">
            <div class="dropdown col-2">
                <!-- filterLongTermItems -->
                <selection-filter :items="orders" :values="filterLongTermConfig.values" :all="filterLongTermConfig.all" :by="filterLongTermConfig.by" @change="filterLongTerm($event)"></selection-filter>
            </div>
            <div class="dropdown col-2">
                <!-- filterStatusItems -->
                <selection-filter :items="filterLongTermItems" :values="filterStatusConfig.values" :all="filterStatusConfig.all" :by="filterStatusConfig.by" @change="filterStatus($event)"></selection-filter>
            </div>
            <div class="col-7">
                <!-- searchInputItems -->
                <search-input :items="filterStatusItems" :by="['guest_name', 'id', 'stocker.name']" placeholder="Nhập tên hoặc mã" @change="searchInput($event)"></search-input>
            </div>
            <a :href="orderCreateUrl" type="button" class="btn btn-success ml-auto">Tạo đơn</a>
        </div>
        <div class="row">
            <table v-if="searchInputItems.length > 0" class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th @click="sort('id')" style="width: 5%;" class="align-middle text-center" scope="col">Mã</th>
                        <th @click="sort('guest_name')" style="width: 18%;" class="align-middle text-center" scope="col">Người mượn</th>
                        <th @click="sort('stocker.name')" style="width: 18%;" class="align-middle text-center" scope="col">Người cho mượn</th>
                        <th style="width: 8%;" class="align-middle text-center" scope="col">Lâu dài</th>
                        <th @click="sort('created_at')" style="width: 16%;" class="align-middle text-center" scope="col">Ngày tạo</th>
                        <th @click="sort('date_output')" style="width: 16%;" class="align-middle text-center" scope="col">Ngày mượn</th>
                        <th @click="sort('status')" style="width: 10%;" class="align-middle text-center" scope="col">Trạng thái</th>
                        <th style="width: 15%;" class="align-middle text-center" scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="cursor-pointer" v-for="order in paginationItems" :key="order.id" :class="rowClass(order.status)" >
                        <th @click="redirect(orderDetailUrl(order.id))" scope="row" class="align-middle text-center">{{order.id}}</th>
                        <td @click="redirect(orderDetailUrl(order.id))" class="text-center align-middle">{{order.guest_name}}</td>
                        <td @click="redirect(orderDetailUrl(order.id))" class="text-center align-middle">{{order.stocker.name}}</td>
                        <td @click="redirect(orderDetailUrl(order.id))" class="text-center align-middle">{{order.long_term|formatBoolean}}</td>
                        <td @click="redirect(orderDetailUrl(order.id))" class="text-center align-middle">{{order.created_at|formatDate}}</td>
                        <td @click="redirect(orderDetailUrl(order.id))" class="text-center align-middle">{{order.date_output|formatDate}}</td>
                        <td @click="redirect(orderDetailUrl(order.id))" class="text-center align-middle">
                            <h6>
                                <order-status :error="checkOrderError(order)" :status="order.status"></order-status>
                            </h6>
                        </td>
                        <td class="align-middle">
                            <button :disabled="order.status != -1 && order.status != 4" type="button" class="btn btn-danger btn-sm" @click="destroyOrder(order.id);">
                                <span class="fa fa-trash"></span>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div v-else class="row justify-content-center">
                <h5>Không tìm thấy đơn mượn nào.</h5>
            </div>
            <div class="row justify-content-center">
                <!-- Paginator -->
                <pagination :items="searchInputItems" @change="pagination($event)"></pagination>
            </div>
        </div>
    </div>
</template>
<script>
import ObjectMixin from '../mixins/ObjectMixin';
import OrderMixin from '../mixins/OrderMixin';
export default {
    mixins: [ObjectMixin, OrderMixin],
    props: [
        'orders',
        'orderCreateUrl',
        'orderIndexUrl',
    ],
    data() {
        return {
            filterLongTermConfig: {
                values: [
                    {name: 'Ngắn hạn', value: 0},
                    {name: 'Lâu dài', value: 1}
                    ],
                all: {name: 'Loại đơn', value: -1},
                by: 'long_term'
            },
            filterStatusConfig: {
                values: [
                    {name: 'Đang chờ', value: 0},
                    {name: 'Chấp nhận', value: 1},
                    {name: 'Xuất đồ', value: 2},
                    {name: 'Trả đồ', value: 3},
                    {name: 'Hoàn tất', value: 4},
                    {name: 'Từ chối', value: -1}
                    ],
                all: {name: 'Trạng thái', value: -2},
                by: 'status'
            },
            filterLongTermItems: [],
            filterStatusItems: [],
            searchInputItems: [],
            paginationItems: [],
            ascending: true
        };
    },
    created() {
        this.init();
    },
    methods: {
        init() {
            this.initFilterOrderLongTerm();
        },
        
        initFilterOrderLongTerm() {
            this.filterLongTermItems = this.orders;
        },
        filterLongTerm(items) {
            this.filterLongTermItems = items;
        },
        filterStatus(items) {
            this.filterStatusItems = items;
        },
        searchInput(items) {
            this.searchInputItems = items;
        },
        pagination(items) {
            this.paginationItems = items;
        },
        orderDetailUrl(id) {
            return this.orderIndexUrl + '/' + id;
        },
        orderDestroyUrl(id) {
            return this.orderIndexUrl + '/' + id;
        },
        destroyOrder(id) {
            console.log('destroy');
            let index = this.orders.findIndex(x => x.id == id);
            this.orders.splice(index, 1);
            axios.delete(this.orderDestroyUrl(id))
                .then(res => {
                    console.log(res);
                }).catch(err => {
                    console.log(err);
                });
        },
        getOrderRequestAmount(order) {
            let total = 0;
            order.order_request_infos.forEach(element => {
                total += element.amount;
            });
            return total;
        },
        getOrderBorrowedAmount(order) {
            let total = 0;
            order.order_request_infos.forEach(element => {
                total += element.order_infos.length;
            });
            return total;
        },
        rowClass(status) {
            return {
                'table-danger': status == -1,
                'table-warning': status == 0,
                'table-primary': status > 0 && status < 4,
                'table-secondary': status == 4 
            };
        },
        redirect(url) {
            console.log(url);
            window.location.href = url;
        },
        sort(att) {
            let app = this;
            let sign = this.ascending ? 1 : -1;
            this.ascending = !this.ascending;
            this.searchInputItems = this.searchInputItems.sort(function(a, b) {
                let aValue = app.getAtt(a, att).toString();
                let bValue = app.getAtt(b, att).toString();
                return sign * aValue.localeCompare(bValue);
            });
        },
    }
}
</script>
<style scoped>
    
</style>