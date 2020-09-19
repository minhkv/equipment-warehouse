<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="main-card mb-3 card col-md-12">
                <!-- <div class="card-header">
                    <div class="btn-actions-pane-right">
                        <div class="nav">
                            <a data-toggle="tab" href="#tab-eg2-0" class="btn-pill btn-wide active btn btn-outline-alternate btn-sm">Đơn mượn</a>
                            <a data-toggle="tab" href="#tab-eg2-1" class="btn-pill btn-wide mr-1 ml-1  btn btn-outline-alternate btn-sm">Đơn nhập</a>
                        </div>
                    </div>
                </div> -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-eg2-0" role="tabpanel">
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
                                    <search-input :items="filterStatusItems" :by="['guest_name', 'id']" @change="searchInput($event)"></search-input>
                                </div>
                                <a :href="orderCreateUrl" type="button" class="btn btn-success ml-auto">Tạo đơn</a>
                            </div>
                            <div class="row">
                                <table v-if="searchInputItems.length > 0" class="table table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="width: 5%;" class="align-middle text-center" scope="col">Mã</th>
                                            <th style="width: 18%;" class="align-middle text-center" scope="col">Người mượn</th>
                                            <th style="width: 8%;" class="align-middle text-center" scope="col">Lâu dài</th>
                                            <th style="width: 18%;" class="align-middle text-center" scope="col">Lý do mượn</th>
                                            <th style="width: 16%;" class="align-middle text-center" scope="col">Ngày tạo</th>
                                            <th style="width: 8%;" class="align-middle text-center" scope="col">Yêu cầu</th>
                                            <th style="width: 9%;" class="align-middle text-center" scope="col">Cho mượn</th>
                                            <th style="width: 10%;" class="align-middle text-center" scope="col">Trạng thái</th>
                                            <th style="width: 15%;" class="align-middle text-center" scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="cursor-pointer" v-for="order in paginationItems" :key="order.id" :class="rowClass(order.status)" >
                                            <th @click="redirect(orderDetailUrl(order.id))" scope="row" class="align-middle text-center">{{order.id}}</th>
                                            <td @click="redirect(orderDetailUrl(order.id))" class="text-center align-middle">{{order.guest_name}}</td>
                                            <td @click="redirect(orderDetailUrl(order.id))" class="text-center align-middle">{{order.long_term|formatBoolean}}</td>
                                            <td @click="redirect(orderDetailUrl(order.id))" class="text-center align-middle">{{order.reason}}</td>
                                            <td @click="redirect(orderDetailUrl(order.id))" class="text-center align-middle">{{order.created_at|formatDate}}</td>
                                            <td @click="redirect(orderDetailUrl(order.id))" class="text-center align-middle">{{ getOrderRequestAmount(order) }}</td>
                                            <td @click="redirect(orderDetailUrl(order.id))" class="text-center align-middle">{{ getOrderBorrowedAmount(order) }} </td>
                                            <td @click="redirect(orderDetailUrl(order.id))" class="text-center align-middle">
                                                <h6>
                                                    <order-status :status="order.status"></order-status>
                                                </h6>
                                            </td>
                                            <td class="align-middle">
                                                <button :disabled="order.status != -1 && order.status != 4" type="button" class="btn btn-danger btn-sm" @click="destroyOrder(order.id);filterOrder();">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
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
                'table-success': status == 4 
            };
        },
        redirect(url) {
            console.log(url);
            window.location.href = url;
        }
    }
}
</script>
<style scoped>
    
</style>