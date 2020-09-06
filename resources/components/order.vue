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
                                    <select v-model="longTerm" v-on:change="filterOrder" class="custom-select mx-0">
                                        <option selected value='-1'>Loại đơn</option>
                                        <option value='0'>Ngắn hạn</option>
                                        <option value='1'>Lâu dài</option>
                                    </select>
                                </div>
                                <div class="dropdown col-2">
                                    <select v-model="orderStatus" v-on:change="filterOrder" class="custom-select mx-0">
                                        <option selected value='-2'>Trạng thái</option>
                                        <option value='-1'>Từ chối</option>
                                        <option value='0'>Khởi tạo</option>
                                        <option value='2'>Đang tiến hành</option>
                                        <option value='4'>Hoàn tất</option>
                                    </select>
                                </div>
                                <div class="col-7">
                                    <form class="my-2 my-lg-0 px-2">
                                        <div class="input-group">
                                            <input v-model="search" v-on:keyup="filterOrder" class="form-control mr-sm-2" type="search" placeholder="Nhập mã hoặc tên người mượn" aria-label="search" aria-describedby="basic-addon2">
                                            <button class="btn btn-outline-primary my-2 my-sm-0" type="button"><span class="fa fa-search"></span></button>
                                        </div>
                                    </form>
                                </div>
                                <a :href="orderCreateUrl" type="button" class="btn btn-success ml-auto">Tạo đơn</a>
                            </div>
                            <div class="row">
                                <table v-if="displayedOrders.length > 0" class="table">
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
                                        <tr v-for="order in paginate(displayedOrders)" :key="order.id">
                                            <th scope="row" class="align-middle text-center">{{order.id}}</th>
                                            <td class="text-center align-middle">{{order.guest_name}}</td>
                                            <td class="text-center align-middle">{{order.long_term|formatBoolean}}</td>
                                            <td class="text-center align-middle">{{order.reason}}</td>
                                            <td class="text-center align-middle">{{order.created_at|formatDate}}</td>
                                            <td class="text-center align-middle">{{ getOrderRequestAmount(order) }}</td>
                                            <td class="text-center align-middle">{{ getOrderBorrowedAmount(order) }} </td>
                                            <td class="text-center align-middle">
                                                <!-- <h5>{{$order->getStatus()}}</h5> -->
                                                <h6>
                                                    <span :class="getOrderStatusClass(order.status)">{{ getOrderStatusName(order.status) }}</span>
                                                </h6>
                                            </td>
                                            <td class="align-middle">
                                                <a :href="orderDetailUrl(order.id)" class="btn btn-primary btn-sm"><span class="fa fa-pencil" /></a>
                                                <button v-if="order.status == -1 || order.status == 4" type="button" class="btn btn-danger btn-sm" @click="destroyOrder(order.id);filterOrder();">
                                                    <span class="fa fa-trash"></span>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div v-else class="row justify-content-center">
                                    <h5>Không tìm thấy đơn mượn nào.</h5>
                                </div>
                                <!-- Paginator -->
                                <div class="row justify-content-center">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                            <li class="page-item"><button class="page-link active" href="#" :disabled="page <= 1" @click="page--">Previous</button></li>
                                            <li :class="{'page-item': true, 'active': page==pageNumber}" v-for="pageNumber in pages.slice(page-1, page+5)" :key="pageNumber"><a class="page-link" href="#"  @click="page = pageNumber">{{pageNumber}}</a></li>
                                            <li class="page-item"><button class="page-link" href="#" @click="page++" :disabled="page >= pages.length">Next</button></li>
                                        </ul>
                                    </nav>
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
            displayedOrders: [],
            longTerm: -1,
            search: '',
            orderStatus: -2,
            page: 1,
            perPage: 8,
            pages: [],
        };
    },
    created() {
        this.filterOrder();
    },
    methods: {
        orderDetailUrl(id) {
            return this.orderIndexUrl + '/' + id;
        },
        orderDestroyUrl(id) {
            return this.orderIndexUrl + '/' + id;
        },
        filterOrder() {
            this.selectedType();
            this.filterOrderStatus();
            this.searchOrder();
            this.setPages();
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
        selectedType() {
            if(this.longTerm == -1) {
                this.displayedOrders = this.orders;
            } else {
                this.displayedOrders = this.orders.filter(x => x.long_term == this.longTerm);
            }
        },
        searchOrder() {
            this.displayedOrders = this.displayedOrders.filter(x => {
                var name = this.normalizeSearchString(x.guest_name);
                var search = this.normalizeSearchString(this.search);
                return name.includes(search) || x.id.toString().includes(search);
            });
        },
        normalizeSearchString(str) {
            return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
        },
        filterOrderStatus() {
            if(this.orderStatus == -2) {
                return;
            } else if(this.orderStatus == -1 || this.orderStatus == 0 || this.orderStatus == 4) {
                this.displayedOrders = this.displayedOrders.filter(x => x.status == this.orderStatus);
            } else {
                this.displayedOrders = this.displayedOrders.filter(x => x.status > 0 && x.status < 4)
            }
        },
        setPages() {
            var itemPerPage = this.perPage;
            let numberOfPages = Math.ceil(this.displayedOrders.length / itemPerPage);
            this.page = 1;
            this.pages = [];
            for (let index = 1; index <= numberOfPages; index++) {
                this.pages.push(index);
            }
        },
        paginate(itemList) {
            let page = this.page;
            let from = (page * this.perPage) - this.perPage;
            let to = (page * this.perPage);
            return itemList.slice(from, to);
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
        getOrderStatusClass(status) {
            return {
                'badge': true, 
                'badge-pill': true, 
                'badge-danger': status == -1,
                'badge-warning': status == 0,
                'badge-primary': status >= 1 && status <= 3,
                'badge-success': status == 4
            };
        },
        getOrderStatusName(status) {
            switch(status) {
                case -1: return 'Từ chối';
                case 0: return 'Khởi tạo';
                case 1: return 'Chấp nhận';
                case 2: return 'Xuất đồ';
                case 3: return 'Trả đồ';
                case 4: return 'Hoàn tất';
            }
        }
    }
}
</script>
<style scoped>

</style>