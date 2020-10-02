<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>Đơn nhập thiết bị</h2>
            </div>
        </div>
        <div class="row py-4">

            <div class="col-7">
                <!-- searchInputItems -->
                <search-input :items="orders" :by="['supplier_name', 'id', 'stocker.name']" placeholder="Nhập tên hoặc mã" @change="searchInput($event)"></search-input>
            </div>
            <a :href="orderCreateUrl" type="button" class="btn btn-success ml-auto">Tạo đơn</a>
        </div>
        <div class="row">
            <table class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th style="width: 5%;" class="align-middle text-center" scope="col">Mã</th>
                        <th style="width: 18%;" class="align-middle text-center" scope="col">Nhà cung cấp</th>
                        <th style="width: 18%;" class="align-middle text-center" scope="col">Người nhập</th>
                        <th style="width: 16%;" class="align-middle text-center" scope="col">Ngày nhập</th>
                        <th style="width: 16%;" class="align-middle text-center" scope="col">Số lượng nhập</th>
                        <th style="width: 15%;" class="align-middle text-center" scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="cursor-pointer" v-for="order in searchInputItems" :key="order.id">
                        <th data-toggle="modal" :data-target="'#detail' + order.id" scope="row" class="align-middle text-center">{{order.id}}</th>
                        <td class="text-center align-middle">{{order.supplier_name}}</td>
                        <td class="text-center align-middle">{{order.stocker.name}}</td>
                        <td class="text-center align-middle">{{order.date_input}}</td>
                        <td class="text-center align-middle">{{getInputAmount(order)}}</td>
                        <td class="align-middle">
                            <button class="btn btn-primary btn-sm" data-toggle="modal" :data-target="'#detail' + order.id">Chi tiết</button>
                            <button @click="removeOrder(order)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row justify-content-center">
            <pagination @change="pagination($event)" :items="searchInputItems" per="8"></pagination>
        </div>
        <modal-component v-for="order in orders" :key="order.id" :id="'detail' + order.id" size="lg" :title="'Chi tiết đơn nhập ' + order.id">
            <input-order-detail :order="order"></input-order-detail>
        </modal-component>
    </div>
</template>
<script>
import RequestMixin from '../mixins/RequestMixin';
export default {
    mixins: [RequestMixin],
    props: ['orders', 'orderCreateUrl', 'orderIndexUrl'],
    data() {
        return {
            displayedOrders: [],
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
            this.displayedOrders = this.orders;
        },
        getInputAmount(order) {
            let total = 0;
            order.order_request_infos.forEach(requestInfo => {
                total += requestInfo.amount;
            });
            return total;
        },
        removeOrder(order) {
            let url = this.orderIndexUrl + '/' + order.id;
            let app = this;
            this.sendRequest(url, 'delete', {}, function(data) {
                console.log(data);
                let index = app.displayedOrders.findIndex(x => x.id == order.id);
                app.displayedOrders.splice(index, 1);
            });
        },
        searchInput(items) {
            this.searchInputItems = items;
        },
        pagination(items) {
            this.paginationItems = items;
        },
    }
}
</script>
<style scoped>

</style>