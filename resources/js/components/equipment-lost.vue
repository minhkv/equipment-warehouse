<template>
    <div id="lostEquipmentView" class="container">
        <div class="row">
            <div class="row py-3">
                <div class="col-md-12 text-center">
                    <h2>Danh sách thiết bị thất lạc</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <table class="table" v-if="displayedEquipments.length > 0">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="text-center" style="width: 5%;">Mã</th>
                            <th scope="col" class="text-center" style="width: 10%;">Hình ảnh</th>
                            <th scope="col" class="text-center" style="width: 15%;">Tên</th>
                            <th scope="col" class="text-center" style="width: 7%;">Mã đơn</th>
                            <th scope="col" class="text-center" style="width: 13%;">Người mượn</th>
                            <th scope="col" class="text-center" style="width: 12%;">Ngày mượn</th>
                            <th scope="col" class="text-center" style="width: 15%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(equipment, index) in displayedEquipments" :key="equipment.id">
                            <th class="align-middle text-center" scope="row">{{equipment.id}}</th>
                            <td class="align-middle text-center">
                                <img class="equipmentImg" height=40 :src="equipment.template.image" :alt="equipment.name">
                            </td>
                            <td class="align-middle text-center">{{ equipment.template.name }}</td>
                            <td class="align-middle text-center">{{ getRecentOrder(equipment).id }}</td>
                            <td class="align-middle text-center">{{ getRecentOrder(equipment).guest_name }}</td>
                            <td class="align-middle text-center">{{ getRecentOrder(equipment).created_at|formatDate }}</td>
                            <td class="align-middle text-center">
                                <button type="button" class="btn btn-primary" data-toggle="modal" :data-target="'#checkEquipment' + equipment.id">
                                    Tìm thấy đồ
                                </button>
                                <button type="button" class="btn btn-danger" @click="deleteEquipment(equipment, index)">
                                    <span class="fa fa-trash"></span>
                                </button>
                                <div class="modal fade" v-bind:id="'checkEquipment' + equipment.id" tabindex="-1" role="dialog" aria-labelledby="addEquipmentLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="">Nhập thiết bị {{equipment.id}}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <table class="table mb-0">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th class="text-center" scope="col" style="width: 5%;">Mã</th>
                                                            <th class="text-center" scope="col" style="width: 20%;">Tình trạng trước khi mượn</th>
                                                            <th class="text-center" scope="col" style="width: 25%;">Tình trạng sau khi mượn</th>
                                                            <th class="text-center" scope="col" style="width: 25%;">Ghi chú</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th class="text-center align-middle" scope="row">{{ equipment.id }}</th>
                                                            <td class="text-center align-middle">
                                                                <equipment-condition :condition="equipment.condition"></equipment-condition>
                                                            </td>
                                                            <td class="text-center align-middle">
                                                                <select-condition :initValue="recentOrderInfos[equipment.id].condition_received" @change="setConditionReceived($event, equipment.id)"></select-condition>
                                                            </td>
                                                            <td class="text-center">
                                                                <textarea v-model="equipment.note" class="form-control" name="note" cols="10"></textarea>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button @click="receivedLostEquipment(equipment, index)" type="button" class="btn btn-primary" data-dismiss="modal">Xong</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <!-- Modal -->
                        </tr>
                    </tbody>
                </table>
                <h5 v-else>Không có thiết bị nào bị thất lạc.</h5>

            </div>
        </div>
    </div>
</template>
<style scoped>
    .checked {
        color: orange;
    }
    .starrating > input {display: none;}  /* Remove radio buttons */

    .starrating > label:before { 
    content: "\f005"; /* Star */
    margin: 2px;
    font-size: 2em;
    font-family: FontAwesome;
    display: inline-block; 
    }

    .starrating > label
    {
    color: #222222; /* Start color when not clicked */
    font-size: 0.5rem;
    }

    .starrating > input:checked ~ label
    { color: #ffca08 ; } /* Set yellow color when star checked */

    .starrating > input:hover ~ label
    { color: #ffca08 ;  } /* Set yellow color when star hover */
</style>
<script>
export default {
    props:[
        'lostEquipments',
        'recentOrderInfos',
        'equipmentIndexUrl',
    ],
    data(){
        return {
            displayedEquipments: {},
            scoreDescriptions: {}
        }
    },
    created() {
        let recentOrderInfos = this.recentOrderInfos;
        this.displayedEquipments = this.lostEquipments;
        this.lostEquipments.forEach(function(equipment) {
            recentOrderInfos[equipment.id].condition_received = equipment.condition;
        });

    },
    methods: {
        setConditionReceived(condition, equipment_id) {
            this.recentOrderInfos[equipment_id].condition_received = condition;
        },
        getRecentOrder: function(equipment) {
            if (this.recentOrderInfos[equipment.id])
                return this.recentOrderInfos[equipment.id].order_request_info.order;
            else
                return {
                    id: 'không rõ',
                    guest: {
                        name: 'không rõ'
                    },
                    created_at: 'không rõ'
                };
        },
        deleteEquipment: function(equipment, index) {
            console.log('/equipment/' + equipment.id);
            if(!confirm('Bạn có chắc chắn muốn xóa?')) {
                return;
            }
            axios.delete(this.equipmentIndexUrl + '/' + equipment.id)
                .then(res => {
                    console.log(res);
                }).catch(error => {
                    console.log("handlesubmit error: ", error);
                });
            this.displayedEquipments.splice(index, 1);
        },
        receivedLostEquipment: function(equipment, index) {
            console.log('received ' + equipment.id);
            var equipmentReceivedUrl = '/equipment-template-lost-received/' + equipment.id;
            axios({
                    url: equipmentReceivedUrl,
                    method: 'put',
                    data: {
                        recentOrderInfos: this.recentOrderInfos[equipment.id],
                        equipment: equipment
                    }
                })
                .then(function(response) {
                    console.log(response);
                    // window.location.reload();
                })
                .catch(function(error) {
                    console.log(error);
                });
            this.displayedEquipments.splice(index, 1);
        },

    }
}
</script>