<template>
    <div class="container">
        <article class="card">
            <div class="card-body">
                <!-- <div class="row"> -->
                <a :href="orderIndexUrl" class="btn btn-light mb-3" data-abc="true">
                    <i class="fa fa-chevron-left"></i> Quay lại
                </a>
                <h3>Đơn mượn: {{order.id}} 
                    <order-status :status="order.status"></order-status>
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
                    <div :class="{'step': true, 'active': order.status >=0}">
                        <span class="icon"> <i class="fa fa-book"></i> </span>
                        <span class="text">Tạo đơn hàng</span>
                        <span class="text-muted">{{order.created_at|formatDate}}</span>
                    </div>
                    <div :class="{'step': true, 'active': order.status >=1}">
                        <span class="icon"> <i class="fa fa-check"></i> </span>
                        <span class="text">Chấp nhận</span>
                        <span class="text-muted">{{order.date_approved|formatDate}}</span>
                    </div>
                    <div :class="{'step': true, 'active': order.status >=2}">
                        <span class="icon"> <i class="fa fa-user"></i> </span>
                        <span class="text"> Xuất đồ</span>
                        <span class="text-muted">{{order.date_output|formatDate}}</span>
                    </div>
                    <div :class="{'step': true, 'active': order.status >=3}">
                        <span class="icon"> <i class="fa fa-truck"></i> </span>
                        <span class="text"> Trả đồ </span>
                        <span class="text-muted">{{order.date_received|formatDate}}</span>
                    </div>
                    <div :class="{'step': true, 'active': order.status >=4}">
                        <span class="icon"> <i class="fa fa-thumbs-up"></i> </span>
                        <span class="text">Hoàn tất</span>
                        <span class="text-muted">{{order.date_completed|formatDate}}</span>
                    </div>
                </div>
                <hr>
                <div class="row justify-content-center">
                    <order-title :status="order.status"></order-title>
                </div>
                <div class="row mb-4">
                    <div class="col-6 mx-auto">
                        <form class="my-2 my-lg-0 px-2">
                            <div class="input-group">
                                <input v-on:keyup="filterInfo" v-model="search" class="form-control mr-sm-2" type="search" placeholder="Tìm kiếm">
                                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit"><span class="fa fa-search"></span></button>
                            </div>
                        </form>
                    </div>
                </div>

                <table class="table mt-2 templateTable">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center" scope="col" width="10%"></th>
                            <th class="text-center" scope="col" width="20%">Tên thiết bị</th>
                            <th class="text-center" scope="col" width="10%">Số lượng</th>
                            <th class="text-center" scope="col" width="10%">Yêu cầu</th>
                            <th class="text-center" scope="col" width="10%">Cho mượn</th>
                            <th v-if="order.status >= 2" class="text-center" scope="col" width="10%">Đã trả</th>
                            <th v-if="order.status >= 2" class="text-center" scope="col" width="10%">Thất lạc</th>
                            <th class="text-center" scope="col" width="10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="info in paginate(displayedInfos)" :key="info.id" :class="{'table-success': getBorrowedAmount(info.template_id) > 0 && (getBorrowedAmount(info.template_id) == getReceivedAmount(info.template_id) + getLostAmount(info.template_id))}">
                            <th class="text-center" scope="row"><img :src="info.template.image" height=40 :alt="info.template.name"></th>
                            <td class="align-middle text-center">{{ info.template.name }}</td>
                            <td class="align-middle text-center">{{ info.template.equipments.length }}</td>
                            <td class="align-middle text-center">{{ info.amount }}</td>
                            <td class="align-middle text-center">
                                {{ getBorrowedAmount(info.template.id) }}
                            </td>
                            <td v-if="order.status >= 2" class="align-middle text-center font-weight-bold">
                                {{ getReceivedAmount(info.template.id) }}
                            </td>
                            <td v-if="order.status >= 2" :class="{'align-middle': true, 'text-center': true, 'font-weight-bold': true, 'bg-danger': getLostAmount(info.template_id) > 0, 'text-light': getLostAmount(info.template_id) > 0}">
                                {{ getLostAmount(info.template.id) }}
                            </td> 
                            <td class="align-middle text-center">
                                <button v-if="order.status > 0" type="button" class="btn btn-primary btn-sm" data-toggle="modal" :data-target="'#addEquipment-' + info.template.id">
                                    <span class="fa fa-pencil"></span>
                                </button>

                                <div class="modal fade" :id="'addEquipment-' + info.template.id" tabindex="-1" role="dialog" :aria-labelledby="'addEquipmentLabel-' + info.template.id" aria-hidden="true">
                                    <div class="modal-dialog modal-xl" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 v-if="order.status <= 1" class="modal-title" :id="'addEquipmentLabel-' + info.template.id">Thêm thiết bị {{info.template.name}}</h5>
                                                <h5 v-else class="modal-title" :id="'verifyEquipmentLabel-' + info.template.id">Kiểm thiết bị {{info.template.name}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <table v-if="order.status <= 1" class="table">
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
                                                            <td class="text-center align-middle">{{ equipment.supplier.name }}</td>
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
                                                <table v-else class="table">
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
                                                                {{ orderInfo.equipment.id }}
                                                            </th>
                                                            <td class="text-center align-middle">
                                                                <equipment-condition :condition="orderInfo.condition_before"></equipment-condition>
                                                            </td>
                                                            <td class="text-center align-middle">
                                                                <div v-if="order.status <= 2" :id="orderInfo.equipment.id" >
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
                                                                <textarea v-if="order.status <= 2" v-model="orderInfo.note" class="form-control" name="note" cols="10"></textarea>
                                                                <div v-else>{{ orderInfo.note }}</div>
                                                            </td>
                                                            <td class="align-middle text-center pb-5">
                                                                <div class="form-check">
                                                                    <input :disabled="equipmentLost[orderInfo.equipment.id]" type="checkbox" class="form-check-input" v-model="equipmentReceived[orderInfo.equipment.id]">
                                                                </div>
                                                            </td>
                                                            <td class="align-middle text-center pb-5">
                                                                <div class="form-check">
                                                                    <input :disabled="equipmentReceived[orderInfo.equipment.id]" type="checkbox" class="form-check-input" v-model="equipmentLost[orderInfo.equipment.id]">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Xong</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
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

                
                <hr>
                <div class="row justify-content-center">
                    <button v-if="order.status >= 1 && order.status <= 3" :disabled="buttonDisabled" @click="back" class="btn btn-secondary mr-2">Quay lại</button>
                    <button v-if="order.status == 0" :disabled="buttonDisabled" @click="acceptOrder" class="btn btn-primary mx-2" data-abc="true">Chấp nhận</button>
                    <button v-if="order.status == 0" :disabled="buttonDisabled" @click="rejectOrder" class="btn btn-danger" data-abc="true">Từ chối</button>
                    <button v-if="order.status == 1" :disabled="buttonDisabled" @click="equipmentOutput" class="btn btn-primary" data-abc="true">Xuất đồ</button>
                    <button v-if="order.status == 2" :disabled="buttonDisabled" @click="equipmentReturn" class="btn btn-primary" data-abc="true">Trả đồ</button>
                    <button v-if="order.status == 3" :disabled="buttonDisabled" @click="completeOrder" class="btn btn-primary" data-abc="true">Hoàn tất</button>
                </div>
            </div>
        </article>
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
            equipmentIds: [],
            buttonDisabled: false,
            templateBorrowedAmount: [],
            equipmentSelected: [],
            equipmentReceived: [],
            equipmentLost: [],
            orderRequestInfos: [],
            displayedInfos: [],
            search: '',
            page: 1,
            perPage: 8,
            pages: [],
        };
    },
    created() {
        let equipmentSelected = {};
        let equipmentReceived = {};
        let equipmentLost = {};
        let equipmentIds = [];
        let templateBorrowedAmount = {};
        let orderRequestInfos = {};
        this.order.order_request_infos.forEach(function(info) {
            info.template.equipments.forEach(function(equipment) {
                equipmentSelected[equipment.id] = false;
            });
            info.order_infos.forEach(function(order_info) {
                if(order_info.condition_before == undefined) {
                    order_info.condition_before = order_info.equipment.condition;
                }
                if(order_info.condition_received == undefined) {
                    order_info.condition_received = order_info.equipment.condition;
                }
                equipmentSelected[order_info.equipment_id] = true;
                equipmentReceived[order_info.equipment_id] = (order_info.status == 1);
                equipmentLost[order_info.equipment_id] = (order_info.status == 0);
                equipmentIds.push(order_info.equipment_id);
            });
            orderRequestInfos[info.template.id] = info;
            orderRequestInfos[info.template.id]['order_infos'] = info.order_infos;
            templateBorrowedAmount[info.template.id] = info.order_infos.length;
        });
        this.equipmentSelected = equipmentSelected;
        this.equipmentReceived = equipmentReceived;
        this.equipmentLost = equipmentLost;
        this.equipmentIds = equipmentIds;
        this.templateBorrowedAmount = templateBorrowedAmount;
        this.orderRequestInfos = orderRequestInfos;

        this.filterInfo();
    },
    methods: {
        getBorrowedAmount: function(template_id) {
            return this.templateBorrowedAmount[template_id];
        },
        isEquipmentSelected: function(equipmentId) {
            return this.equipmentSelected[equipmentId];
        },
        disablePlusEquipmentButton: function(equipmentId, equipmentStatus) {
            return this.isEquipmentSelected(equipmentId) || equipmentStatus != 1;
        },
        disableMinusEquipmentButton: function(equipmentId, equipmentStatus) {
            return !this.isEquipmentSelected(equipmentId);
        },
        selectEquipment: function(equipment, template_id) {
            console.log('select');
            this.orderRequestInfos[template_id].order_infos.push({
                'equipment_id': equipment.id,
                'condition_before': equipment.condition
            });
            this.templateBorrowedAmount[template_id]++;
            this.equipmentIds.push(equipment.id);
            this.equipmentSelected[equipment.id] = true;
        },
        removeEquipment: function(equipment_id, template_id) {
            console.log('remove');
            this.templateBorrowedAmount[template_id]--;
            const index = this.equipmentIds.indexOf(equipment_id);
            if (index > -1) {
                this.equipmentIds.splice(index, 1);
            }
            this.equipmentSelected[equipment_id] = false;
        },
        getReceivedAmount: function(template_id) {
            let total = 0;
            for (let i in this.orderRequestInfos[template_id].order_infos) {
                let orderInfo = this.orderRequestInfos[template_id].order_infos[i];
                if (this.equipmentReceived[orderInfo.equipment_id]) {
                    total += 1;
                }
            }

            return total;
        },
        getLostAmount: function(template_id) {
            let total = 0;
            for (let i in this.orderRequestInfos[template_id].order_infos) {
                let orderInfo = this.orderRequestInfos[template_id].order_infos[i];
                if (this.equipmentLost[orderInfo.equipment_id]) {
                    total += 1;
                }
            }

            return total;
        },
        normalText(id, selected) {
            document.getElementById(id).innerHTML = "Đánh giá";
        },
        changeText(id, text) {
            document.getElementById(id).innerHTML = text;
        },
        back: function() {
            this.disableButton();
            axios.put(this.backUrl).then(res => {
                console.log(res);
                window.location.reload();
            }).catch(error => {
                console.log("handlesubmit error: ", error);
            });
        },
        getCurrentLocalTime() {
            let currentDate = (new Date()).toISOString();
            return moment(currentDate).format();
        },
        acceptOrder: function(button) {
            this.disableButton();
            axios.put(this.acceptUrl, {
                dateApproved: this.getCurrentLocalTime()
            }).then(res => {
                console.log(res);
                window.location.reload();
            }).catch(error => {
                console.log("handlesubmit error: ", error);
            });
        },
        rejectOrder: function() {
            console.log(this.orderIndexUrl);
            this.disableButton();
            axios.put(this.rejectUrl)
                .then(res => {
                    console.log(res);
                    window.location.assign(this.orderIndexUrl);
                }).catch(error => {
                    console.log("handlesubmit error: ", error);
                });
        },
        equipmentCheckBorrowedAmount: function() {
            for(let key in this.templateBorrowedAmount) {
                console.log(this.templateBorrowedAmount[key]);
                if(this.templateBorrowedAmount[key] == 0) {
                    alert('Bạn chưa chọn thiết bị ' + this.orderRequestInfos[key].template.name);
                    return false;
                }
            }
            return true;
        },
        equipmentOutput: function() {
            console.log('equipmentOutput');
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
                .then(function(response) {
                    console.log(response);
                    window.location.reload();
                })
                .catch(function(error) { 
                    console.log(error);
                });
        },
        getEquipmentStatus: function(equipmentId) {
            if (this.equipmentReceived[equipmentId])
                return 1;
            if (this.equipmentLost[equipmentId])
                return 0;
            return 2;
        },
        updateOrderInfoStatus: function() {
            for (let i in this.orderRequestInfos) {
                for (let j in this.orderRequestInfos[i].order_infos) {
                    var orderInfo = this.orderRequestInfos[i].order_infos[j];
                    orderInfo.status = this.getEquipmentStatus(orderInfo.equipment_id);
                }
            }
        },
        equipmentCheck: function() {
            for (let i in this.orderRequestInfos) {
                for (let j in this.orderRequestInfos[i].order_infos) {
                    let orderInfo = this.orderRequestInfos[i].order_infos[j];
                    if (!this.equipmentLost[orderInfo.equipment.id] && !this.equipmentReceived[orderInfo.equipment.id]) {
                        alert('Bạn chưa chọn trạng thái thiết bị ' + this.orderRequestInfos[i].template.name + ' có mã: ' + orderInfo.equipment.id);
                        return false;
                    }
                }
            }
            return true;
        },
        equipmentReturn: function() {
            console.log('return');
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
                .then(function(response) {
                    console.log(response);
                    window.location.reload();
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        completeOrder: function() {
            this.disableButton();

            axios({
                    url: this.completeUrl,
                    method: 'put',
                    data: {
                        orderRequestInfos: this.orderRequestInfos,
                        dateCompleted: this.getCurrentLocalTime()
                    }
                })
                .then(function(response) {
                    console.log(response);
                    window.location.reload();
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        disableButton: function() {
            this.buttonDisabled = true;
        },
        filterInfo() {
            this.searchInfo();
            this.setPages();
        },
        setPages() {
            var itemPerPage = this.perPage;
            let numberOfPages = Math.ceil(this.displayedInfos.length / itemPerPage);
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
        searchInfo() {
            this.displayedInfos = this.order.order_request_infos.filter(x => {
                var name = this.normalizeSearchString(x.template.name);
                var search = this.normalizeSearchString(this.search);
                return name.includes(search);
            });
        },
        normalizeSearchString(str) {
            return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
        },
        
    }
};
</script>