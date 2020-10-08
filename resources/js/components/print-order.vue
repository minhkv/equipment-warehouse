<template>
    <div class="d-inline-block">
        <button v-if="order.status == 4" @click="print()" class="btn btn-outline-primary"><i class="fa fa-print"></i> In báo cáo</button>
        <button v-if="order.status == 2" @click="print()" class="btn btn-outline-primary"><i class="fa fa-print"></i> In phiếu mượn</button>
        <div id="report" v-show="false">
            <div class="row justify-content-center">
                <h3>Đơn mượn: {{order.id}}</h3>
            </div>
            <div class="col-10 mx-auto py-4">
                <div class="row">
                    <label class="col-3 text-left"><strong><i class="fa fa-user"></i> Người mượn</strong></label>
                    <label class="col-3 text-left">{{order.guest_name}}</label>
                    <label class="col-3 text-left"><strong><i class="fa fa-calendar"></i> Ngày mượn</strong></label>
                    <label class="col-3 text-left">{{order.date_borrowed|formatDateTime}}</label>
                </div>
                <div class="row">
                    <label class="col-3 text-left"><strong><i class="fa fa-building"></i> Phòng ban</strong></label>
                    <label class="col-3 text-left">{{order.department}}</label>
                    <label class="col-3 text-left"><strong><i class="fa fa-calendar"></i> Ngày hẹn trả</strong></label>
                    <label class="col-3 text-left">{{order.date_return|formatDateTime}}</label>
                </div>
                <div class="row">
                    <label class="col-3 text-left"><strong>Mượn lâu dài:</strong></label>
                    <label class="col-3 text-left"> {{order.long_term|formatBoolean}}</label>
                    <label class="col-3 text-left"><strong>Lý do:</strong></label>
                    <label class="col-3 text-left">{{order.reason}}</label>
                </div>
                <div class="row">
                    <label class="col-3 text-left"><strong>Người cho mượn:</strong></label>
                    <label class="col-3 text-left">{{order.stocker.name}}</label>
                    <label class="col-3 text-left"><strong>Ghi chú:</strong></label>
                    <label class="col-3 text-left">{{order.note}}</label>
                </div>
            </div>
            <div>
                <table v-if="order.status == 2" class="table table-bordered mt-2">
                    <thead class="thead-light">
                        <tr>
                            <th class="align-middle text-center" scope="col" width="5%">STT</th>
                            <th class="align-middle text-center" scope="col" width="5%">Mã</th>
                            <th class="align-middle text-center" scope="col" width="20%">Tên thiết bị</th>
                            <th class="align-middle text-center" scope="col" width="15%">Tình trạng</th>
                            <th class="align-middle text-center" scope="col" width="15%">Ghi chú</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(info, index) in orderInfos" :key="'arise' + info.id">
                            <th class=" align-middle text-center" scope="row">{{index + 1}}</th>
                            <td class=" align-middle text-center" scope="row">{{info.equipment.id}}</td>
                            <td class="align-middle text-center">{{ info.template_name }}</td>
                            <td class="align-middle text-center">{{ info.condition_before | formatEquipmentCondition }}</td>
                            <td class="align-middle text-center">{{ info.note }}</td>
                        </tr>
                    </tbody>
                </table>
                <table v-if="order.status == 4" class="table table-bordered mt-2">
                    <thead class="thead-light">
                        <tr>
                            <th class="align-middle text-center" scope="col" width="5%">STT</th>
                            <th class="align-middle text-center" scope="col" width="5%">Mã</th>
                            <th class="align-middle text-center" scope="col" width="20%">Tên thiết bị</th>
                            <th class="align-middle text-center" scope="col" width="10%">Trạng thái</th>
                            <th class="align-middle text-center" scope="col" width="15%">Trước khi mượn</th>
                            <th class="align-middle text-center" scope="col" width="15%">Sau khi mượn</th>
                            <th class="align-middle text-center" scope="col" width="15%">Ghi chú</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(info, index) in orderInfos" :key="'arise' + info.id">
                            <th class=" align-middle text-center" scope="row">{{index + 1}}</th>
                            <td class=" align-middle text-center" scope="row">{{info.equipment.id}}</td>
                            <td class="align-middle text-center">{{ info.template_name }}</td>
                            <td class="align-middle text-center">{{ info.status|formatInfoStatus }}</td>
                            <td class="align-middle text-center">{{ info.condition_before | formatEquipmentCondition }}</td>
                            <td class="align-middle text-center">{{ info.condition_received | formatEquipmentCondition }}</td>
                            <td class="align-middle text-center">{{ info.note }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['order'],
    data () {
        return {
            orderInfos: [],
            output: null,
            buttonLabel: ''
        }
    },
    created() {
        this.init();
    },
    methods: {
        init() {
            this.initOrderInfos();
        },
        initOrderInfos() {
            this.order.order_request_infos.forEach(requestInfo => {
                requestInfo.order_infos.forEach(orderInfo => {
                    let item = orderInfo;
                    Vue.set(item, 'template_name', requestInfo.template.name);
                    this.orderInfos.push(item);
                });
            });
        },
        print () {
            this.$htmlToPaper('report');
        },
        getBorrowedAmountByInfo(info) {
            return info.order_infos.length;
        },
        getReceivedAmount(info) {
            let total = 0;
            info.order_infos.forEach(orderInfo => {
                if (orderInfo.status == 1) {
                    total ++;
                }
            });
            return total;
        },
        getLostAmount(info) {
            let total = 0;
            info.order_infos.forEach(orderInfo => {
                if (orderInfo.status == 0) {
                    total ++;
                }
            });
            return total;
        },
    }
}
</script>

<style scoped>
table.table-bordered{
    border:1px solid black;
    margin-top:20px;
}
table.table-bordered > thead > tr > th{
    border:1px solid black;
}
table.table-bordered > tbody > tr > td{
    border:1px solid black;
}
</style>