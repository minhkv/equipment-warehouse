<template>
    <div class="container">

        <a :href="orderIndexUrl" class="btn btn-outline-dark mb-3" data-abc="true">
            <i class="fa fa-chevron-left"></i> Quay lại
        </a>
        <div class="row">
            <div class="col-5">
                <h3>Đơn mượn: {{displayedOrder.id}} 
                    <order-status :status="displayedOrder.status"></order-status>
                </h3>
            </div>
            <div class="ml-auto">
                <print-order v-if="displayPrint()" :order="displayedOrder"></print-order>
                <button @click="duplicate(displayedOrder)" class="btn btn-primary">
                    <i class="fa fa-clone"></i> Sao chép đơn
                </button>
            </div>
        </div>
        <div class="col-10 mx-auto py-3">
            <div class="row">
                <label class="col-3 text-left"><strong><i class="fa fa-user"></i> Người mượn</strong></label>
                <label class="col-3 text-left">{{displayedOrder.guest_name}}</label>
                <label class="col-3 text-left"><strong><i class="fa fa-calendar"></i> Ngày mượn</strong></label>
                <label class="col-3 text-left">{{displayedOrder.date_borrowed|formatDateTime}}</label>
            </div>
            <div class="row">
                <label class="col-3 text-left"><strong><i class="fa fa-building"></i> Phòng ban</strong></label>
                <label class="col-3 text-left">{{displayedOrder.department}}</label>
                <label class="col-3 text-left"><strong><i class="fa fa-calendar"></i> Ngày hẹn trả</strong></label>
                <label class="col-3 text-left">{{displayedOrder.date_return|formatDateTime}}</label>
            </div>
            <div class="row">
                <label class="col-3 text-left"><strong>Mượn lâu dài:</strong></label>
                <label class="col-3 text-left"> {{displayedOrder.long_term|formatBoolean}}</label>
                <label class="col-3 text-left"><strong>Lý do:</strong></label>
                <label class="col-3 text-left">{{displayedOrder.reason}}</label>
            </div>
            <div class="row">
                <label class="col-3 text-left"><strong>Người cho mượn:</strong></label>
                <label class="col-3 text-left">{{displayedOrder.stocker.name}}</label>
                <label class="col-3 text-left"><strong>Ghi chú:</strong></label>
                <label class="col-3 text-left">{{displayedOrder.note}}</label>
            </div>
            <div v-show="displayNote()" class="row">
                <label class="col-3 text-left"><strong>Thiết bị</strong></label>
                <label class="col-3 text-left">{{note}}</label>
            </div>
        </div>
        
        <div class="track">
            <div :class="{'step': true, 'active': displayedOrder.status >=0}">
                <span class="icon"> <i class="fa fa-book"></i> </span>
                <span class="text">Tạo đơn hàng</span>
                <span class="text-muted">{{displayedOrder.created_at|formatDateTime}}</span>
            </div>
            <div :class="{'step': true, 'active': displayedOrder.status >=1}">
                <span class="icon"> <i class="fa fa-check"></i> </span>
                <span class="text">Chấp nhận</span>
                <span class="text-muted">{{displayedOrder.date_approved|formatDateTime}}</span>
            </div>
            <div :class="{'step': true, 'active': displayedOrder.status >=2}">
                <span class="icon"> <i class="fa fa-user"></i> </span>
                <span class="text"> Xuất đồ</span>
                <span class="text-muted">{{displayedOrder.date_output|formatDateTime}}</span>
            </div>
            <div :class="{'step': true, 'active': displayedOrder.status >=3}">
                <span class="icon"> <i class="fa fa-truck"></i> </span>
                <span class="text"> Trả đồ </span>
                <span class="text-muted">{{displayedOrder.date_received|formatDateTime}}</span>
            </div>
            <div :class="{'step': true, 'active': displayedOrder.status >=4}">
                <span class="icon"> <i class="fa fa-thumbs-up"></i> </span>
                <span class="text">Hoàn tất</span>
                <span class="text-muted">{{displayedOrder.date_completed|formatDateTime}}</span>
            </div>
        </div>
        <hr>
        <div class="row justify-content-center">
            <order-title :status="displayedOrder.status"></order-title>
        </div>
        <div class="row mb-4">
            <div class="col-6 mx-auto">
                <!-- Search -->
                <search-input :items="this.displayedOrder.order_request_infos" :by="['template.name']" @change="searchInput($event)"></search-input>
            </div>
        </div>

        <table-display-info @change="freshSelectedTemplates($event)" :status="displayedOrder.status" :items="paginationItems"></table-display-info>
        <div class="row justify-content-center">
            <!-- Paginator -->
            <pagination :items="searchInputItems" :per="6" @change="pagination($event)"></pagination>
        </div>
        <div v-if="displayedOrder.status == 1 && ariseRequest.length > 0" >
            <div class="row justify-content-center">
                <h4>Phát sinh thêm</h4>
            </div>

            <table class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th class="text-center" scope="col" width="10%"></th>
                        <th class="text-center" scope="col" width="50%">Tên thiết bị</th>
                        <th class="text-center" scope="col" width="10%">Số lượng</th>
                        <th class="text-center" scope="col" width="10%">Yêu cầu</th>
                        <th class="text-center" scope="col" width="10%">Cho mượn</th>
                        <th class="text-center pr-1" scope="col" width="5%"></th>
                        <th class="text-center" scope="col" width="10%"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="info in ariseRequest" :key="info.id">
                        <th class="text-center" scope="row"><img :src="info.template.image" height=40 :alt="info.template.name"></th>
                        <td class="align-middle text-center">{{ info.template.name }}</td>
                        <td class="align-middle text-center">
                            {{ info.template.equipments.length }}
                        </td>
                        <td class="align-middle text-center">
                            <input 
                                class="form-control" 
                                type="number" 
                                name="amount" 
                                min='0' 
                                :max='info.template.maxAmount' 
                                v-model="info.template.amount"
                                @change="updateAriseAmount(info)"
                                >
                        </td>
                        <td class="align-middle text-center">
                            {{ (info.order_infos.length) }}
                        </td>
                        
                        <td class="align-middle text-center">
                            <div v-if="displayedOrder.status > 0" >
                                <button v-if="displayedOrder.status <= 1" type="button" class="btn btn-primary btn-sm" data-toggle="modal" :data-target="'#ariseEquipment-' + info.template.id">
                                    <span class="fa fa-edit"></span>
                                </button>
                            </div>
                        </td>
                        <td class="align-middle text-center">
                            <button @click="removeAriseRequest(info)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
            
        </div>
        <div v-if="displayedOrder.status == 1" class="row justify-content-center">
            <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#addAriseTemplate">
                Thêm thiết bị
            </button>
        </div>
        <hr>
        <div class="row justify-content-center">
            <button v-if="displayedOrder.status >= 1 && displayedOrder.status <= 3" :disabled="buttonDisabled" @click="back" class="btn btn-secondary mr-2">
                <i class="fa fa-chevron-left"></i> Quay lại
            </button>
            <button v-if="displayedOrder.status == 1 || displayedOrder.status == 2" :disabled="buttonDisabled" @click="saveStatus" class="btn btn-primary mr-2">Lưu <i class="fas fa-save"></i></button>

            <button v-if="displayedOrder.status == 0" :disabled="buttonDisabled" @click="acceptOrder" class="btn btn-primary mx-2" data-abc="true">Chấp nhận</button>
            <button v-if="displayedOrder.status == 0" :disabled="buttonDisabled" @click="rejectOrder" class="btn btn-danger" data-abc="true">Từ chối</button>
            <button v-if="displayedOrder.status == 1" :disabled="buttonDisabled" @click="equipmentOutput" class="btn btn-primary" data-abc="true">
                Xuất đồ <i class="fa fa-chevron-right"></i>
            </button>
            <button v-if="displayedOrder.status == 2" :disabled="buttonDisabled" @click="equipmentReturn" class="btn btn-primary" data-abc="true">
                Trả đồ <i class="fa fa-chevron-right"></i>
            </button>
            <button v-if="displayedOrder.status == 3" :disabled="buttonDisabled" @click="completeOrder" class="btn btn-success" data-abc="true">Hoàn tất <i class="fa fa-check"></i></button>
        </div>

        <modal-component v-for="(info, i) in displayedOrder.order_request_infos" :key="'a' + info.id" :id="'addEquipment-' + info.template.id" :title="'Thêm thiết bị ' + info.template.name" size="xl">
            <table-select-equipment @change="updateCurrentEquipment($event, i)" :requestInfo="info"></table-select-equipment>
            <template v-slot:footer>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Xong</button>
            </template>
        </modal-component>

        <modal-component v-for="(info, i) in ariseRequest" :key="'arise' + i" :id="'ariseEquipment-' + info.template.id" :title="'Thêm thiết bị ' + info.template.name" size="xl">
            <table-select-equipment @change="updateAriseEquipment($event, i)" :requestInfo="info"></table-select-equipment>
            <template v-slot:footer>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Xong</button>
            </template>
        </modal-component>

        <modal-component v-for="info in displayedOrder.order_request_infos" :key="'v' + info.id" :id="'verifyEquipment-' + info.template.id" :title="'Kiểm thiết bị ' + info.template.name" size="xl">
            <table-verify-equipment :orderInfos="info.order_infos" :status="displayedOrder.status"></table-verify-equipment>
            <template v-slot:footer>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Xong</button>
            </template>
        </modal-component>

        <modal-component id="addAriseTemplate" title="Thiết bị phát sinh thêm" size="lg">
            <table-select-template @change="updateRequest($event)" :items="equipmentTemplates" :initTemplates="selectedTemplates" :categories="categories" 
            :templateNeedToRemove="templateNeedToRemove.template" :clear="clear"></table-select-template>
            <template v-slot:footer>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Xong</button>
            </template>
        </modal-component>
    </div>
</template>

<script>
import moment from 'moment';
import RequestMixin from '../../mixins/RequestMixin';
import OrderMixin from '../../mixins/OrderMixin';
export default {
    mixins: [RequestMixin, OrderMixin],
    props: [
        "categories",
        "equipmentTemplates",
        "order",
        "orderIndexUrl",
        "acceptUrl",
        "rejectUrl",
        "equipmentOutputUrl",
        "equipmentReturnUrl",
        "completeUrl",
        "backUrl",
        "orderCreateUrl"
        ],
    data() {
        return {
            displayedOrder: {},
            buttonDisabled: false,
            orderRequestInfos: [],
            displayedInfos: [],
            search: '',
            searchInputItems: [],
            paginationItems: [],
            selectedTemplates: [],
            ariseRequest: [],
            templateNeedToRemove: {},
            save: false,
            clear: false,
            note: ''
        };
    },
    created() {
        this.initOrder();
        this.initialize();
    },
    methods: {
        initialize() {
            this.initNote();
            this.initializeOrderRequestInfos();
            this.initSearchInput();
            this.initSelectedTemplates();
        },
        initOrder() {
            Object.assign(this.displayedOrder, this.order);
        },
        setOrder(order) {
            this.displayedOrder = order;
        },
        initializeOrderRequestInfos() {
            let orderRequestInfos = {};
            this.displayedOrder.order_request_infos.forEach(function(info) {
                info.order_infos.forEach(function(order_info) {
                    if(order_info.condition_before == undefined) {
                        order_info.condition_before = order_info.equipment.condition;
                    }
                    if(order_info.condition_received == undefined) {
                        order_info.condition_received = order_info.equipment.condition;
                    }
                });
                orderRequestInfos[info.template.id] = info;
            });
            this.orderRequestInfos = orderRequestInfos;
        },
        initNote() {
            if(this.displayNote()  && !this.note) {
                this.note = "Thất lạc: " + this.getTotalLostAmount();
                this.note += ', Lỗi: ' + this.getTotalErrorAmount();
            }
        },
        displayNote() {
            return this.displayedOrder.status >= 2;
        },
        initSearchInput() {
            this.searchInputItems = this.displayedOrder.order_request_infos;
        },
        initSelectedTemplates() {
            this.selectedTemplates = this.displayedOrder.order_request_infos.map(function(info) {
                return {
                    id: info.template.id,
                    name: info.template.name,
                    amount: info.amount,
                    maxAmount: info.template.equipments.length,
                    image: info.template.image,
                };
            });
        },
        getTotalLostAmount() {
            let total = 0;
            this.displayedOrder.order_request_infos.forEach(requestInfo => {
                requestInfo.order_infos.forEach(orderInfo => {
                    if(orderInfo.status == 0) {
                        total ++;
                    }
                });
            });
            return total;
        },
        getTotalErrorAmount() {
            let total = 0;
            this.displayedOrder.order_request_infos.forEach(requestInfo => {
                requestInfo.order_infos.forEach(orderInfo => {
                    if(orderInfo.condition_received == 0) {
                        total ++;
                    }
                });
            });
            return total;
        },
        freshRequest(data) {
            console.log('fresh');
            this.freshOriginTemplates(data.origin);
            this.freshSelectedTemplates();
        },
        freshOriginTemplates(templates) {
            let newRequestInfos = this.displayedOrder.order_request_infos.filter(requestInfo => {
                let index = templates.findIndex(template => {return template.id == requestInfo.template_id});
                return index != -1;
            });
            Vue.set(this.displayedOrder, 'order_request_infos', newRequestInfos);
        },
        freshSelectedTemplates() {
            this.selectedTemplates = [];
            this.initSelectedTemplates();
        },
        updateRequest(data) {
            this.updateOriginRequest(data);
            this.updateAriseRequest(data);
            this.updateClientRequest(data);
        },
        updateOriginRequest(data) {
            let app = this;
            this.freshOriginTemplates(data.origin);
            data.origin.forEach(function (template) {
                let orderInfo = app.displayedOrder.order_request_infos.find(info => {
                    return info.template.id == template.id;
                });
                Vue.set(orderInfo, 'amount', template.amount);
            });
        },
        updateClientRequest(data) {
            let app = this;
            this.orderRequestInfos = {};
            this.displayedOrder.order_request_infos.forEach(request => {
                Vue.set(this.orderRequestInfos, request.template_id, request);
            });
        },
        updateAriseRequest(data) {
            let app = this;
            this.ariseRequest = data.arise.map(function(template) {
                return ({
                    amount: template.amount,
                    borrowed_amount: 0,
                    order_infos: [],
                    order_id: app.displayedOrder.id,
                    template: template,
                    template_id: template.id
                });
            });
        },
        updateAriseAmount(info) {
            info.amount = info.template.amount;
        },
        removeAriseRequest(request) {
            this.templateNeedToRemove = request;
            let index = this.ariseRequest.findIndex(req => {
                return req.template.id == request.template.id;
            });
            this.ariseRequest.splice(index, 1);
        },
        getBorrowedAmountByInfo(info) {
            return info.order_infos.length;
        },
        
        searchInput(items) {
            this.searchInputItems = items;
        },
        pagination(items) {
            this.paginationItems = items;
        },
        updatePage(data) {
            if(data.error) {
                alert(data.error);
            } else if(data.test) {
                alert(data.test);
            } else {
                this.setOrder(data);
                this.initialize();
            }
            this.save = false;
            this.clear = false;
            this.enableButton();
        },
        updateCurrentEquipment(orderInfos, index) {
            this.updateEquipment(orderInfos, index, this.displayedOrder.order_request_infos);
        },
        updateAriseEquipment(orderInfos, index) {
            this.updateEquipment(orderInfos, index, this.ariseRequest);
        },
        updateEquipment(orderInfos, index, orderRequest) {
            let requestInfo = orderRequest[index];
            Vue.set(requestInfo, 'order_infos', orderInfos);
            Vue.set(orderRequest, index, requestInfo);
        },
        back() {
            let app = this;
            this.disableButton();
            this.sendRequest(this.backUrl, 'put', {}, this.updatePage);
        },
        saveStatus() {
            this.save = true;
            if(this.displayedOrder.status == 1) {
                this.equipmentOutput();
            } else if(this.displayedOrder.status == 2) {
                this.equipmentReturn();
            }
        },
        getCurrentLocalTime() {
            let currentDate = (new Date()).toISOString();
            return moment(currentDate).format();
        },
        acceptOrder(button) {
            let app = this;
            this.disableButton();
            axios.put(this.acceptUrl, {
                dateApproved: this.getCurrentLocalTime()
            }).then(res => {
                console.log(res);
                app.updatePage(res.data);
            }).catch(error => {
                console.log("handlesubmit error: ", error);
            });
        },
        rejectOrder() {
            console.log(this.orderIndexUrl);
            let app = this;
            this.disableButton();
            axios.put(this.rejectUrl)
                .then(res => {
                    console.log(res);
                    app.updatePage(res.data);
                }).catch(error => {
                    console.log("handlesubmit error: ", error);
                });
        },
        equipmentCheckBorrowedAmount() {
            if(this.save) return true;
            return this.checkRequestAmount(this.displayedOrder.order_request_infos) &&
                this.checkRequestAmount(this.ariseRequest);
        },
        checkRequestAmount(requestInfos){
            return requestInfos.every(info => {
                if(info.order_infos.length == 0) {
                    alert("Số lượng mượn của thiết bị " + info.template.name + " phải > 0");
                }
                return info.order_infos && info.order_infos.length > 0;
            });
        },
        equipmentOutput() {
            console.log('equipmentOutput');
            let app = this;
            if(!this.equipmentCheckBorrowedAmount()) return;
            this.disableButton();
            this.ariseRequest.forEach(request => {
                Vue.set(this.orderRequestInfos, request.template_id, request);
            });
            this.ariseRequest = [];
            this.selectedTemplates = [];
            let data = {
                orderRequestInfos: this.orderRequestInfos,
                dateOutput: this.getCurrentLocalTime(),
                save: this.save
            };
            this.clear = true;
            this.sendRequest(this.equipmentOutputUrl, 'put', data, this.updatePage);
        },
        equipmentCheck() {
            if(this.save) return true;
            for (let i in this.orderRequestInfos) {
                for (let j in this.orderRequestInfos[i].order_infos) {
                    let orderInfo = this.orderRequestInfos[i].order_infos[j];
                    if (orderInfo.status == 2) {
                        alert('Bạn chưa chọn trạng thái thiết bị ' + this.orderRequestInfos[i].template.name + ' có mã: ' + orderInfo.equipment_id);
                        return false;
                    }
                }
            }
            return true;
        },
        equipmentReturn() {
            console.log('return');
            let app = this;
            if (!this.equipmentCheck()) return;
            console.log(this.orderRequestInfos);
            this.disableButton();
            let data = {
                orderRequestInfos: this.orderRequestInfos,
                dateReturn: this.getCurrentLocalTime(),
                save: this.save
            };
            this.sendRequest(this.equipmentReturnUrl, 'put', data, this.updatePage);
        },
        completeOrder() {
            let app = this;
            this.disableButton();
            let data = {
                orderRequestInfos: this.orderRequestInfos,
                dateCompleted: this.getCurrentLocalTime()
            };
            this.sendRequest(this.completeUrl, 'put', data, this.updatePage);
        },
        enableButton() {
            this.buttonDisabled = false;
        },
        disableButton() {
            this.buttonDisabled = true;
        },
        displayPrint() {
            return this.order.status == 4 || this.order.status == 2;
        },
    }
};
</script>