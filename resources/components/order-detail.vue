<template>
    <div class="container">
        <article class="card">
            <div class="card-body">
                <!-- <div class="row"> -->
                <a :href="orderIndexUrl" class="btn btn-light mb-3" data-abc="true">
                    <i class="fa fa-chevron-left"></i> Quay lại
                </a>
                <h3>Đơn mượn: {{order.id}} 
                    <span :class="displayStatus()">{{getStatusName(order.status)}}</span>
                    </h3>
                <!-- <article class="card">
                    <div class="card-body row">
                        <div class="col"> <strong><i class="fa fa-user"></i> Người mượn:</strong> <br>{{order.guest_name}} </div>
                        <div class="col"> <strong><i class="fa fa-user"></i> Phòng ban:</strong> <br>{{order.department}} </div>
                        <div class="col"> <strong>Mượn lâu dài:</strong> <br> {{order.long_term|formatBoolean}} </div>
                    </div>
                    <div class="card-body row">
                        <div class="col"> <strong><i class="fa fa-calendar"></i> Ngày mượn:</strong> <br> {{order.date_borrowed}} </div>
                        <div class="col"> <strong><i class="fa fa-calendar"></i> Ngày hẹn trả:</strong> <br> {{order.date_return}} </div>
                        <div class="col"> <strong>Lý do:</strong> <br> {{order.reason}} </div>
                        <div class="col"> <strong>Ghi chú:</strong> <br> {{order.note}} </div>
                    </div>
                </article> -->

                <div class="col-8 mx-auto py-3">
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
                        <span class="text-muted">{{order.date_output}}</span>
                    </div>
                    <div :class="{'step': true, 'active': order.status >=3}">
                        <span class="icon"> <i class="fa fa-truck"></i> </span>
                        <span class="text"> Trả đồ </span>
                        <span class="text-muted">{{order.date_received}}</span>
                    </div>
                    <div :class="{'step': true, 'active': order.status >=4}">
                        <span class="icon"> <i class="fa fa-thumbs-up"></i> </span>
                        <span class="text">Hoàn tất</span>
                        <span class="text-muted">{{order.date_completed}}</span>
                    </div>
                </div>
                <hr>
                <div class="row justify-content-center">
                    <h3>
                        {{ getTitle() }}
                    </h3>
                </div>
                <ul class="row justify-content-center">
                    <li v-for="info in order.order_request_infos" :key="info.id" class="col-md-4">
                        <figure class="itemside mb-3 border">
                            <div class="aside"><img :src="info.template.image" class="img-sm border"></div>
                            <figcaption class="info align-self-center">
                                <h5 class="title">{{info.template.name}}</h5>
                                <div class="form-group row" v-if="order.status <= 1">
                                    <label :for="'borrowed-amount-' + info.template.id" class="col-sm-6 col-form-label">Yêu cầu</label>
                                    <div class="col-sm-4">
                                        <input class="form-control" disabled type="number" :value="info.amount">
                                    </div>
                                </div>

                                <div v-if="order.status >= 1">
                                    <div class="form-group row">
                                        <label :for="'borrowed-amount-' + info.template.id" class="col-sm-6 col-form-label">Cho mượn</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" disabled type="number" :value="getBorrowedAmount(info.template.id)">
                                        </div>
                                        <button v-if="order.status < 3" type="button" class="btn btn-primary btn-sm" data-toggle="modal" :data-target="'#addEquipment-' + info.template.id">
                                            <span class="fa fa-pencil"></span>
                                        </button>
                                    </div>
                                </div>
                                <div class="modal fade" :id="'addEquipment-' + info.template.id" tabindex="-1" role="dialog" :aria-labelledby="'addEquipmentLabel-' + info.template.id" aria-hidden="true">
                                    <div class="modal-dialog modal-xl" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 v-if="order.status <= 1" class="modal-title" :id="'addEquipmentLabel-' + info.template.id">Thêm thiết bị {{info.template.id}}</h5>
                                                <h5 v-else class="modal-title" :id="'verifyEquipmentLabel-' + info.template.id">Kiểm thiết bị {{info.template.id}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <table v-if="order.status <= 1" class="table">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th class="text-center" scope="col" style="width: 5%">Mã</th>
                                                            <th class="text-center" scope="col" style="width: 10%;">Kích thước</th>
                                                            <th class="text-center" scope="col" style="width: 10%;">Giá nhập</th>
                                                            <th class="text-center" scope="col" style="width: 12%;">Nhà cung cấp</th>
                                                            <th class="text-center" scope="col" style="width: 8%;">Vị trí</th>
                                                            <th class="text-center" scope="col" style="width: 10%;">Tình trạng</th>
                                                            <th class="text-center" scope="col" style="width: 10%;">Trạng thái</th>
                                                            <th class="text-center" scope="col" style="width: 15%;">Ghi chú</th>
                                                            <th class="text-center" scope="col" style="width: 10%;"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="equipment in info.template.equipments" :key="equipment.id">
                                                            <th class="text-center align-middle" scope="row">{{ equipment.id }}</th>
                                                            <td class="text-center align-middle">{{ equipment.size}}</td>
                                                            <td class="text-center align-middle">{{ equipment.price }}</td>
                                                            <td class="text-center align-middle">{{ equipment.supplier.name }}</td>
                                                            <td class="text-center align-middle">{{ equipment.location }}</td>
                                                            <td class="text-center align-middle">
                                                                <div>
                                                                    <span :class="{'fa': true, 'fa-star': true, 'checked':  equipment.condition >= 1}"></span>
                                                                    <span :class="{'fa': true, 'fa-star': true, 'checked':  equipment.condition >= 2}"></span>
                                                                    <span :class="{'fa': true, 'fa-star': true, 'checked':  equipment.condition >= 3}"></span>
                                                                    <span :class="{'fa': true, 'fa-star': true, 'checked':  equipment.condition >= 4}"></span>
                                                                    <span :class="{'fa': true, 'fa-star': true, 'checked':  equipment.condition >= 5}"></span>
                                                                </div>
                                                            </td>
                                                            <td class="align-middle text-center">
                                                                <span :class="displayEquipmentStatusClass(equipment.status)">
                                                                    {{getEquipmentStatusName(equipment.status)}}
                                                                </span>
                                                            </td>
                                                            <td>{{equipment.note}}</td>
                                                            <td class="align-middle">
                                                                <button :disabled="disablePlusEquipmentButton(equipment.id, equipment.status)" @click="selectEquipment(equipment.id, info.template.id)" class="btn btn-success btn-sm"><span class="fa fa-plus"></span></button>
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
                                                                <div>
                                                                    <span :class="{'fa': true, 'fa-star': true, 'checked':  orderInfo.equipment.condition >= 1}"></span>
                                                                    <span :class="{'fa': true, 'fa-star': true, 'checked':  orderInfo.equipment.condition >= 2}"></span>
                                                                    <span :class="{'fa': true, 'fa-star': true, 'checked':  orderInfo.equipment.condition >= 3}"></span>
                                                                    <span :class="{'fa': true, 'fa-star': true, 'checked':  orderInfo.equipment.condition >= 4}"></span>
                                                                    <span :class="{'fa': true, 'fa-star': true, 'checked':  orderInfo.equipment.condition >= 5}"></span>
                                                                </div>
                                                            </td>
                                                            <td class="text-center align-middle">
                                                                <div :id="orderInfo.equipment.id">
                                                                    <div class="starrating risingstar d-flex justify-content-center flex-row-reverse">
                                                                        <input v-model="conditionReceived[orderInfo.equipment.id]" type="radio" :id="'star5-' + orderInfo.equipment.id" :name="'condition-received-' + orderInfo.equipment.id" value="5" :class="{'checked': orderInfo.equipment.condition == 5}"  /><label :for="'star5-' + orderInfo.equipment.id" onmouseout="normalText('scoreDescription-' + orderInfo.equipment.id')" onmouseover="changeText('scoreDescription-' + orderInfo.equipment.id', 'Hoàn hảo')" title="5 star">5</label>
                                                                        <input v-model="conditionReceived[orderInfo.equipment.id]" type="radio" :id="'star4-' + orderInfo.equipment.id" :name="'condition-received-' + orderInfo.equipment.id" value="4" :class="{'checked': orderInfo.equipment.condition == 4}"  /><label :for="'star4-' + orderInfo.equipment.id" onmouseout="normalText('scoreDescription-' + orderInfo.equipment.id')" onmouseover="changeText('scoreDescription-' + orderInfo.equipment.id', 'Tốt')" title="4 star">4</label>
                                                                        <input v-model="conditionReceived[orderInfo.equipment.id]" type="radio" :id="'star3-' + orderInfo.equipment.id" :name="'condition-received-' + orderInfo.equipment.id" value="3" :class="{'checked': orderInfo.equipment.condition == 3}"  /><label :for="'star3-' + orderInfo.equipment.id" onmouseout="normalText('scoreDescription-' + orderInfo.equipment.id')" onmouseover="changeText('scoreDescription-' + orderInfo.equipment.id', 'Bình thường')" title="3 star">3</label>
                                                                        <input v-model="conditionReceived[orderInfo.equipment.id]" type="radio" :id="'star2-' + orderInfo.equipment.id" :name="'condition-received-' + orderInfo.equipment.id" value="2" :class="{'checked': orderInfo.equipment.condition == 2}"  /><label :for="'star2-' + orderInfo.equipment.id" onmouseout="normalText('scoreDescription-' + orderInfo.equipment.id')" onmouseover="changeText('scoreDescription-' + orderInfo.equipment.id', 'Không tốt')" title="2 star">2</label>
                                                                        <input v-model="conditionReceived[orderInfo.equipment.id]" type="radio" :id="'star1-' + orderInfo.equipment.id" :name="'condition-received-' + orderInfo.equipment.id" value="1" :class="{'checked': orderInfo.equipment.condition == 1}"  /><label :for="'star1-' + orderInfo.equipment.id" onmouseout="normalText('scoreDescription-' + orderInfo.equipment.id')" onmouseover="changeText('scoreDescription-' + orderInfo.equipment.id', 'Kém')" title="1 star">1</label>
                                                                    </div>
                                                                    <div class="d-flex justify-content-center">
                                                                        <p :id="'scoreDescription-' + orderInfo.equipment.id">Đánh giá</p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="text-center">
                                                                <textarea class="form-control" name="note" cols="10"></textarea>
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
                                
                                <div v-if="order.status >= 2">
                                    <div class="form-group row">
                                        <label :for="'received-amount-' + info.template.id" class="col-sm-6 col-form-label">Đã nhận</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" :id="'received-amount-' + info.template.id" style="width: 50px;" disabled type="number" :value="getReceivedAmount(info.template.id)">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label :for="'lost-amount-' + info.template.id" class="col-sm-6 col-form-label">Thất lạc</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" :id="'lost-amount-' + info.template.id" style="width: 50px;" disabled type="number" :value="getLostAmount(info.template.id)">
                                        </div>
                                    </div>
                                </div>
                            </figcaption>
                        </figure>
                    </li>
                </ul>
                <hr>

                <div class="row justify-content-center">
                    <button v-if="order.status == 2 || order.status == 3" :disabled="buttonDisabled" @click="back" class="btn btn-secondary mr-2">Quay lại</button>
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
            conditionReceived: []
        };
    },
    created() {
        let equipmentSelected = {};
        let equipmentReceived = {};
        let equipmentLost = {};
        let equipmentIds = [];
        let conditionReceived = {};
        let templateBorrowedAmount = {};
        let orderRequestInfos = {};
        this.order.order_request_infos.forEach(function(info) {
            info.template.equipments.forEach(function(equipment) {
                equipmentSelected[equipment.id] = false;
            });
            info.order_infos.forEach(function(order_info) {
                if(order_info.condition_received) {
                    conditionReceived[order_info.equipment_id] = order_info.condition_received;
                } else {
                    order_info.condition_received = order_info.equipment.condition;
                    conditionReceived[order_info.equipment_id] = order_info.equipment.condition;
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
        this.conditionReceived = conditionReceived;
        this.templateBorrowedAmount = templateBorrowedAmount;
        this.orderRequestInfos = orderRequestInfos;
    },
    methods: {
        displayStatus() {
            return {
                'badge': true, 
                'badge-pill':true, 
                'badge-danger': this.order.status == -1,
                'badge-warning': this.order.status == 0,
                'badge-primary': this.order.status > 0 && this.order.status < 4,
                'badge-success': this.order.status == 4
            };
        },
        getStatusName() {
            switch(this.order.status) {
                case -1:
                    return 'Từ chối';
                case 0:
                    return 'Khởi tạo';
                case 1:
                    return 'Chấp nhận';
                case 2:
                    return 'Xuất đồ';
                case 3:
                    return 'Kiểm đồ';
                case 4:
                    return 'Hoàn tất';
            }
        },
        getTitle() {
            switch(this.order.status) {
                case -1:
                    return 'Từ chối';
                case 0:
                    return 'Duyệt đơn';
                case 1:
                    return 'Chọn đồ';
                case 2:
                    return 'Kiểm đồ';
                case 3:
                    return 'Hoàn tất';
                case 4:
                    return 'Hoàn tất';
            }
        },
        getEquipmentStatusName(status) {
            switch(status) {
                case 0: return "Thất lạc";
                case 1: return "Sẵn sàng";
                case 2: return "Đang cho mượn";
            }
        },
        displayEquipmentStatusClass(status) {
            return {
                'badge': true, 
                'badge-pill':true, 
                'badge-danger': status == 0,
                'badge-success': status == 1,
                'badge-primary': status == 2
            };
        },
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
        selectEquipment: function(equipment_id, template_id) {
            console.log('select');
            this.orderRequestInfos[template_id].order_infos.push({
                'equipment_id': equipment_id
            });
            this.templateBorrowedAmount[template_id]++;
            this.equipmentIds.push(equipment_id);
            this.equipmentSelected[equipment_id] = true;
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
                if (this.equipmentReceived[orderInfo.equipment.id]) {
                    total += 1;
                }
            }

            return total;
        },
        getLostAmount: function(template_id) {
            let total = 0;
            for (let i in this.orderRequestInfos[template_id].order_infos) {
                let orderInfo = this.orderRequestInfos[template_id].order_infos[i];
                if (this.equipmentLost[orderInfo.equipment.id]) {
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
        acceptOrder: function(button) {
            this.disableButton();
            axios.put(this.acceptUrl, {
                date_approved: new Date()
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
            if(!this.equipmentCheckBorrowedAmount()) return;
            this.disableButton();
            axios({
                    url: this.equipmentOutputUrl,
                    method: 'put',
                    data: {
                        equipments: this.equipmentIds,
                        templateBorrowedAmount: this.templateBorrowedAmount,
                        orderRequestInfos: this.orderRequestInfos
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
        updateConditionReceived: function() {
            for (let i in this.orderRequestInfos) {
                for (let j in this.orderRequestInfos[i].order_infos) {
                    var orderInfo = this.orderRequestInfos[i].order_infos[j];
                    orderInfo.condition_received = parseInt(this.conditionReceived[orderInfo.equipment_id]);
                    this.orderRequestInfos[i].order_infos[j].condition_received = orderInfo.condition_received;
                }
            }
        },
        equipmentReturn: function() {
            console.log('return');
            if (!this.equipmentCheck()) return;
            this.updateOrderInfoStatus();
            this.disableButton();
            this.updateConditionReceived();
            axios({
                    url: this.equipmentReturnUrl,
                    method: 'put',
                    data: {
                        orderRequestInfos: this.orderRequestInfos
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
                        orderRequestInfos: this.orderRequestInfos
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
    }
};
</script>