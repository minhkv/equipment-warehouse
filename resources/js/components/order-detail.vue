<template>
    <div class="container">
        <article class="card">
            <div class="card-body">
                <!-- <div class="row"> -->
                <a :href="orderIndexUrl" class="btn btn-light mb-3" data-abc="true">
                    <i class="fa fa-chevron-left"></i> Quay lại
                </a>
                <h3>Đơn mượn: {{order.id}} 
                    <order-status :status="displayedOrder.status"></order-status>
                </h3>
                <div class="col-10 mx-auto py-3">
                    <div class="row">
                        <label class="col-3 text-left"><strong><i class="fa fa-user"></i> Người mượn</strong></label>
                        <label class="col-3 text-left">{{order.guest_name}}</label>
                        <label class="col-3 text-left"><strong><i class="fa fa-calendar"></i> Ngày mượn</strong></label>
                        <label class="col-3 text-left">{{order.date_borrowed|formatDate}}</label>
                    </div>
                    <div class="row">
                        <label class="col-3 text-left"><strong><i class="fa fa-building"></i> Phòng ban</strong></label>
                        <label class="col-3 text-left">{{order.department}}</label>
                        <label class="col-3 text-left"><strong><i class="fa fa-calendar"></i> Ngày hẹn trả</strong></label>
                        <label class="col-3 text-left">{{order.date_return|formatDate}}</label>
                    </div>
                    <div class="row">
                        <label class="col-3 text-left"><strong>Mượn lâu dài:</strong></label>
                        <label class="col-3 text-left"> {{order.long_term|formatBoolean}}</label>
                        <label class="col-3 text-left"><strong>Lý do:</strong></label>
                        <label class="col-3 text-left">{{order.reason}}</label>
                    </div>
                    <div class="row">
                        <label class="col-3 offset-3 text-left"><strong>Ghi chú:</strong></label>
                        <label class="col-6 text-left">{{order.note}}</label>
                    </div>
                </div>
                
                <div class="track">
                    <div :class="{'step': true, 'active': displayedOrder.status >=0}">
                        <span class="icon"> <i class="fa fa-book"></i> </span>
                        <span class="text">Tạo đơn hàng</span>
                        <span class="text-muted">{{order.created_at|formatDate}}</span>
                    </div>
                    <div :class="{'step': true, 'active': displayedOrder.status >=1}">
                        <span class="icon"> <i class="fa fa-check"></i> </span>
                        <span class="text">Chấp nhận</span>
                        <span class="text-muted">{{order.date_approved|formatDate}}</span>
                    </div>
                    <div :class="{'step': true, 'active': displayedOrder.status >=2}">
                        <span class="icon"> <i class="fa fa-user"></i> </span>
                        <span class="text"> Xuất đồ</span>
                        <span class="text-muted">{{order.date_output|formatDate}}</span>
                    </div>
                    <div :class="{'step': true, 'active': displayedOrder.status >=3}">
                        <span class="icon"> <i class="fa fa-truck"></i> </span>
                        <span class="text"> Trả đồ </span>
                        <span class="text-muted">{{order.date_received|formatDate}}</span>
                    </div>
                    <div :class="{'step': true, 'active': displayedOrder.status >=4}">
                        <span class="icon"> <i class="fa fa-thumbs-up"></i> </span>
                        <span class="text">Hoàn tất</span>
                        <span class="text-muted">{{order.date_completed|formatDate}}</span>
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

                <table class="table mt-2 table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center" scope="col" width="10%"></th>
                            <th class="text-center" scope="col" width="20%">Tên thiết bị</th>
                            <th class="text-center" scope="col" width="10%">Số lượng</th>
                            <th class="text-center" scope="col" width="10%">Yêu cầu</th>
                            <th class="text-center" scope="col" width="10%">Cho mượn</th>
                            <th v-if="displayedOrder.status >= 2" class="text-center" scope="col" width="10%">Đã trả</th>
                            <th v-if="displayedOrder.status >= 2" class="text-center" scope="col" width="10%">Thất lạc</th>
                            <th class="text-center" scope="col" width="10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="info in paginationItems" :key="info.id" :class="rowClass(info)">
                            <th class="text-center" scope="row"><img :src="info.template.image" height=40 :alt="info.template.name"></th>
                            <td class="align-middle text-center">{{ info.template.name }}</td>
                            <td class="align-middle text-center">{{ info.template.equipments.length }}</td>
                            <td class="align-middle text-center">{{ info.amount }}</td>
                            <td class="align-middle text-center">
                                {{ getBorrowedAmount(info.template.id) }}
                            </td>
                            <td v-if="displayedOrder.status >= 2" class="align-middle text-center font-weight-bold">
                                {{ getReceivedAmount(info.template.id) }}
                            </td>
                            <td v-if="displayedOrder.status >= 2" :class="cellLostClass(info)">
                                {{ getLostAmount(info.template.id) }}
                            </td> 
                            <td class="align-middle text-center">
                                <div v-if="displayedOrder.status > 0" >
                                    <button v-if="displayedOrder.status <= 1" type="button" class="btn btn-primary btn-sm" data-toggle="modal" :data-target="'#addEquipment-' + info.template.id">
                                        <span class="fa fa-pencil"></span>
                                    </button>
                                    <button v-else type="button" class="btn btn-primary btn-sm" data-toggle="modal" :data-target="'#verifyEquipment-' + info.template.id">
                                        <span class="fa fa-pencil"></span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row justify-content-center">
                    <!-- Paginator -->
                    <pagination :items="searchInputItems" @change="pagination($event)"></pagination>
                </div>
                <hr>
                <div class="row justify-content-center">
                    <button v-if="displayedOrder.status >= 1 && displayedOrder.status <= 3" :disabled="buttonDisabled" @click="back" class="btn btn-secondary mr-2">Quay lại</button>
                    <button v-if="displayedOrder.status == 0" :disabled="buttonDisabled" @click="acceptOrder" class="btn btn-primary mx-2" data-abc="true">Chấp nhận</button>
                    <button v-if="displayedOrder.status == 0" :disabled="buttonDisabled" @click="rejectOrder" class="btn btn-danger" data-abc="true">Từ chối</button>
                    <button v-if="displayedOrder.status == 1" :disabled="buttonDisabled" @click="equipmentOutput" class="btn btn-primary" data-abc="true">Xuất đồ</button>
                    <button v-if="displayedOrder.status == 2" :disabled="buttonDisabled" @click="equipmentReturn" class="btn btn-primary" data-abc="true">Trả đồ</button>
                    <button v-if="displayedOrder.status == 3" :disabled="buttonDisabled" @click="completeOrder" class="btn btn-primary" data-abc="true">Hoàn tất</button>
                </div>
            </div>
        </article>
        <modal-component v-for="info in paginationItems" :key="'a' + info.id" :id="'addEquipment-' + info.template.id" :title="'Thêm thiết bị ' + info.template.name" size="xl">
            <table class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th class="text-center" scope="col" style="width: 5%">Mã</th>
                        <th class="text-center" scope="col" style="width: 10%;">Giá nhập</th>
                        <th class="text-center" scope="col" style="width: 12%;">Nhà cung cấp</th>
                        <th class="text-center" scope="col" style="width: 10%;">Tình trạng</th>
                        <th class="text-center" scope="col" style="width: 10%;">Trạng thái</th>
                        <th class="text-center" scope="col" style="width: 15%;">Ghi chú</th>
                        <th class="text-center" scope="col" style="width: 10%;"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="equipment in info.template.equipments" :key="equipment.id">
                        <th class="text-center align-middle" scope="row">{{ equipment.id }}</th>
                        <td class="text-center align-middle">{{ equipment.price|formatEquipmentPrice }}</td>
                        <td class="text-center align-middle">
                            <supplier-name :equipment="equipment"></supplier-name></td>
                        <td class="text-center align-middle">
                            <equipment-condition :condition="equipment.condition"></equipment-condition>
                        </td>
                        <td class="align-middle text-center">
                            <equipment-status :status="equipment.status"></equipment-status>
                        </td>
                        <td>{{equipment.note}}</td>
                        <td class="align-middle">
                            <button :disabled="disablePlusEquipmentButton(equipment.id, equipment.status)" @click="selectEquipment(equipment, info.template.id)" class="btn btn-success btn-sm"><span class="fa fa-plus"></span></button>
                            <button :disabled="disableMinusEquipmentButton(equipment.id, equipment.status)" @click="removeEquipment(equipment.id, info.template.id)" class="btn btn-danger btn-sm"><span class="fa fa-minus"></span></button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <template v-slot:footer>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Xong</button>
            </template>
        </modal-component>
        <modal-component v-for="info in paginationItems" :key="'v' + info.id" :id="'verifyEquipment-' + info.template.id" :title="'Kiểm thiết bị ' + info.template.name" size="xl">
            <table class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th class="text-center" scope="col" style="width: 5%;">Mã</th>
                        <th class="text-center" scope="col" style="width: 20%;">Tình trạng trước khi mượn</th>
                        <th class="text-center" scope="col" style="width: 25%;">Tình trạng sau khi mượn</th>
                        <th class="text-center" scope="col" style="width: 25%;">Ghi chú</th>
                        <th class="text-center" scope="col">Đã nhận</th>
                        <th class="text-center" scope="col">Thất lạc</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="orderInfo in info.order_infos" :key="orderInfo.id">
                        <th class="text-center align-middle" scope="row">
                            {{ orderInfo.equipment_id }}
                        </th>
                        <td class="text-center align-middle">
                            <equipment-condition :condition="orderInfo.condition_before"></equipment-condition>
                        </td>
                        <td class="text-center align-middle">
                            <div v-if="displayedOrder.status <= 2" :id="orderInfo.equipment_id" >
                                <div class="dropdown">
                                    <select v-model="orderInfo.condition_received" class="custom-select mx-0">
                                        <option selected value='1'><equipment-condition :condition="1"></equipment-condition></option>
                                        <option value='2'><equipment-condition :condition="2"></equipment-condition></option>
                                        <option value='0'><equipment-condition :condition="0"></equipment-condition></option>
                                    </select>
                                </div>
                            </div>
                            <div v-else>
                                <equipment-condition :condition="orderInfo.condition_received"></equipment-condition>
                            </div>
                        </td>
                        <td class="text-center">
                            <textarea v-if="displayedOrder.status <= 2" v-model="orderInfo.note" class="form-control" name="note" cols="10"></textarea>
                            <div v-else>{{ orderInfo.note }}</div>
                        </td>
                        <td class="align-middle text-center pb-5">
                            <div class="form-check">
                                <input :disabled="equipmentLost[orderInfo.equipment_id]" type="checkbox" class="form-check-input" v-model="equipmentReceived[orderInfo.equipment_id]">
                            </div>
                        </td>
                        <td class="align-middle text-center pb-5">
                            <div class="form-check">
                                <input :disabled="equipmentReceived[orderInfo.equipment_id]" type="checkbox" class="form-check-input" v-model="equipmentLost[orderInfo.equipment_id]">
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <template v-slot:footer>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Xong</button>
            </template>
        </modal-component>
    </div>
</template>
<style scoped>
@import url("https://fonts.googleapis.com/css?family=Open+Sans&display=swap");

body {
    background-color: #eeeeee;
    font-family: "Open Sans", serif;
}

.card {
    position: relative;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 0.1rem;
}

.card-header:first-child {
    border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0;
}

.card-header {
    padding: 0.75rem 1.25rem;
    margin-bottom: 0;
    background-color: #fff;
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
}

.track {
    position: relative;
    background-color: #ddd;
    height: 7px;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    margin-bottom: 70px;
    margin-top: 50px;
}

.track .step {
    -webkit-box-flex: 1;
    -ms-flex-positive: 1;
    flex-grow: 1;
    width: 25%;
    margin-top: -18px;
    text-align: center;
    position: relative;
}

.track .step.active:before {
    background: #009aeb;
}

.track .step::before {
    height: 7px;
    position: absolute;
    content: "";
    width: 100%;
    left: 0;
    top: 18px;
}

.track .step.active .icon {
    background: #009aeb;
    color: #fff;
}

.track .icon {
    display: inline-block;
    width: 40px;
    height: 40px;
    line-height: 40px;
    position: relative;
    border-radius: 100%;
    background: #ddd;
}

.track .step.active .text {
    font-weight: 400;
    color: #000;
}

.track .text {
    display: block;
    margin-top: 7px;
}

.itemside {
    position: relative;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    width: 100%;
}

.itemside .aside {
    position: relative;
    -ms-flex-negative: 0;
    flex-shrink: 0;
}

.img-sm {
    width: 80px;
    height: 80px;
    padding: 7px;
}

ul.row,
ul.row-sm {
    list-style: none;
    padding: 0;
}

.itemside .info {
    padding-left: 15px;
    padding-right: 7px;
}

.itemside .title {
    display: block;
    margin-bottom: 5px;
    color: #212529;
}

p {
    margin-top: 0;
    margin-bottom: 1rem;
}

/* .btn-warning {
    color: #ffffff;
    background-color: #ee5435;
    border-color: #ee5435;
    border-radius: 1px
}

.btn-warning:hover {
    color: #ffffff;
    background-color: #ff2b00;
    border-color: #ff2b00;
    border-radius: 1px
} */

.checked {
    color: orange;
}
.starrating > input {
    display: none;
} /* Remove radio buttons */

.starrating > label:before {
    content: "\f005"; /* Star */
    margin: 2px;
    font-size: 2em;
    font-family: FontAwesome;
    display: inline-block;
}

.starrating > label {
    color: #222222; /* Start color when not clicked */
    font-size: 0.5rem;
}

.starrating > input:checked ~ label {
    color: #ffca08;
} /* Set yellow color when star checked */

.starrating > input:hover ~ label {
    color: #ffca08;
} /* Set yellow color when star hover */
</style>
<script>
import moment from 'moment';
export default {
    props: [
        "order",
        "orderIndexUrl",
        "acceptUrl",
        "rejectUrl",
        "equipmentOutputUrl",
        "equipmentReturnUrl",
        "completeUrl",
        "backUrl"
        ],
    data() {
        return {
            displayedOrder: {},
            equipmentIds: [],
            buttonDisabled: false,
            templateBorrowedAmount: [],
            equipmentSelected: [],
            equipmentReceived: [],
            equipmentLost: [],
            orderRequestInfos: [],
            displayedInfos: [],
            search: '',
            searchInputItems: [],
            paginationItems: []
        };
    },
    created() {
        this.initOrder();
        this.initialize();
    },
    methods: {
        initialize() {
            this.initializeOrderRequestInfos();
            this.initializeEquipmentOutput();
            this.initializeEquipmentReturn();
            this.initSearchInput();
        },
        initOrder() {
            Object.assign(this.displayedOrder, this.order);
        },
        setOrder(order) {
            // Object.assign(this.displayedOrder, order);
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
                orderRequestInfos[info.template.id]['order_infos'] = info.order_infos;
            });
            this.orderRequestInfos = orderRequestInfos;
        },
        initializeEquipmentOutput() {
            let equipmentSelected = {};
            let equipmentIds = [];
            let templateBorrowedAmount = {};
            this.displayedOrder.order_request_infos.forEach(function(info) {
                info.template.equipments.forEach(function(equipment) {
                    equipmentSelected[equipment.id] = false;
                });
                info.order_infos.forEach(function(order_info) {
                    equipmentSelected[order_info.equipment_id] = true;
                    equipmentIds.push(order_info.equipment_id);
                });
                templateBorrowedAmount[info.template.id] = info.order_infos.length;
            });
            this.equipmentSelected = equipmentSelected;
            this.equipmentIds = equipmentIds;
            this.templateBorrowedAmount = templateBorrowedAmount;
        },
        initializeEquipmentReturn() {
            let equipmentReceived = {};
            let equipmentLost = {};
            this.displayedOrder.order_request_infos.forEach(function(info) {
                info.order_infos.forEach(function(order_info) {
                    equipmentReceived[order_info.equipment_id] = (order_info.status == 1);
                    equipmentLost[order_info.equipment_id] = (order_info.status == 0);
                });
            });
            this.equipmentReceived = equipmentReceived;
            this.equipmentLost = equipmentLost;
        },
        initSearchInput() {
            this.searchInputItems = this.order.order_request_infos;
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
            } else {
                this.setOrder(data);
                this.initialize();
            }
            this.enableButton();
        },
        rowClass(info) {
            return {
                'table-success': 
                    this.getBorrowedAmount(info.template_id) > 0 &&
                    (this.getBorrowedAmount(info.template_id) == 
                    this.getReceivedAmount(info.template_id) + 
                    this.getLostAmount(info.template_id))
            };
        },
        cellLostClass(info) {
            return {
                'align-middle': true, 
                'text-center': true, 
                'font-weight-bold': true, 
                'bg-danger': this.getLostAmount(info.template_id) > 0, 
                'text-light': this.getLostAmount(info.template_id) > 0
                };
        },
        getBorrowedAmount(template_id) {
            return this.templateBorrowedAmount[template_id];
        },
        isEquipmentSelected(equipmentId) {
            return this.equipmentSelected[equipmentId];
        },
        disablePlusEquipmentButton(equipmentId, equipmentStatus) {
            return this.isEquipmentSelected(equipmentId) || equipmentStatus != 1;
        },
        disableMinusEquipmentButton(equipmentId, equipmentStatus) {
            return !this.isEquipmentSelected(equipmentId);
        },
        selectEquipment(equipment, template_id) {
            console.log('select');
            this.orderRequestInfos[template_id].order_infos.push({
                'equipment_id': equipment.id,
                'condition_before': equipment.condition
            });
            this.templateBorrowedAmount[template_id]++;
            this.equipmentIds.push(equipment.id);
            this.equipmentSelected[equipment.id] = true;
        },
        removeEquipment(equipment_id, template_id) {
            console.log('remove');
            this.templateBorrowedAmount[template_id]--;
            const index = this.equipmentIds.indexOf(equipment_id);
            if (index > -1) {
                this.equipmentIds.splice(index, 1);
            }
            this.equipmentSelected[equipment_id] = false;
        },
        getReceivedAmount(template_id) {
            let total = 0;
            for (let i in this.orderRequestInfos[template_id].order_infos) {
                let orderInfo = this.orderRequestInfos[template_id].order_infos[i];
                if (this.equipmentReceived[orderInfo.equipment_id]) {
                    total += 1;
                }
            }

            return total;
        },
        getLostAmount(template_id) {
            let total = 0;
            for (let i in this.orderRequestInfos[template_id].order_infos) {
                let orderInfo = this.orderRequestInfos[template_id].order_infos[i];
                if (this.equipmentLost[orderInfo.equipment_id]) {
                    total += 1;
                }
            }

            return total;
        },
        back() {
            let app = this;
            this.disableButton();
            axios.put(this.backUrl).then(res => {
                console.log(res);
                app.updatePage(res.data);
            }).catch(error => {
                console.log("handlesubmit error: ", error);
            });
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
            for(let key in this.templateBorrowedAmount) {
                console.log(this.templateBorrowedAmount[key]);
                if(this.templateBorrowedAmount[key] == 0) {
                    alert('Bạn chưa chọn thiết bị ' + this.orderRequestInfos[key].template.name);
                    return false;
                }
            }
            return true;
        },
        equipmentOutput() {
            console.log('equipmentOutput');
            let app = this;
            if(!this.equipmentCheckBorrowedAmount()) return;
            this.disableButton();
            axios({
                    url: this.equipmentOutputUrl,
                    method: 'put',
                    data: {
                        equipments: this.equipmentIds,
                        templateBorrowedAmount: this.templateBorrowedAmount,
                        orderRequestInfos: this.orderRequestInfos,
                        dateOutput: this.getCurrentLocalTime()
                    }
                })
                .then(function(res) {
                    console.log(res);
                    app.updatePage(res.data);
                })
                .catch(function(error) { 
                    console.log(error);
                });
        },
        getEquipmentStatus(equipmentId) {
            if (this.equipmentReceived[equipmentId])
                return 1;
            if (this.equipmentLost[equipmentId])
                return 0;
            return 2;
        },
        updateOrderInfoStatus() {
            for (let i in this.orderRequestInfos) {
                for (let j in this.orderRequestInfos[i].order_infos) {
                    var orderInfo = this.orderRequestInfos[i].order_infos[j];
                    orderInfo.status = this.getEquipmentStatus(orderInfo.equipment_id);
                }
            }
        },
        equipmentCheck() {
            for (let i in this.orderRequestInfos) {
                for (let j in this.orderRequestInfos[i].order_infos) {
                    let orderInfo = this.orderRequestInfos[i].order_infos[j];
                    if (!this.equipmentLost[orderInfo.equipment_id] && !this.equipmentReceived[orderInfo.equipment_id]) {
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
            this.updateOrderInfoStatus();
            console.log(this.orderRequestInfos);
            this.disableButton();
            axios({
                    url: this.equipmentReturnUrl,
                    method: 'put',
                    data: {
                        orderRequestInfos: this.orderRequestInfos,
                        dateReturn: this.getCurrentLocalTime()
                    }
                })
                .then(function(res) {
                    console.log(res);
                    app.updatePage(res.data);
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        completeOrder() {
            let app = this;
            this.disableButton();

            axios({
                    url: this.completeUrl,
                    method: 'put',
                    data: {
                        orderRequestInfos: this.orderRequestInfos,
                        dateCompleted: this.getCurrentLocalTime()
                    }
                })
                .then(function(res) {
                    console.log(res);
                    app.updatePage(res.data);
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        enableButton() {
            this.buttonDisabled = false;
        },
        disableButton() {
            this.buttonDisabled = true;
        },

        
    }
};
</script>