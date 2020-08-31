<template>
    <div id="lostEquipmentView" class="container">
        <div class="row">
            <div class="row py-3">
                <div class="col-md-12 text-center">
                    <h2>Danh sách thiết bị thất lạc</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <table class="table" v-if="lostEquipments.length > 0">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="text-center" style="width: 5%;">Mã</th>
                            <th scope="col" class="text-center" style="width: 10%;">Hình ảnh</th>
                            <th scope="col" class="text-center" style="width: 15%;">Tên</th>
                            <th scope="col" class="text-center" style="width: 7%;">Mã đơn</th>
                            <th scope="col" class="text-center" style="width: 13%;">Người mượn</th>
                            <th scope="col" class="text-center" style="width: 10%;">Ngày mượn</th>
                            <th scope="col" class="text-center" style="width: 15%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(equipment, index) in lostEquipments" :key="equipment.id">
                            <th class="align-middle text-center" scope="row">{{equipment.id}}</th>
                            <td class="align-middle text-center">
                                <img class="equipmentImg" :src="equipment.template.image" :alt="equipment.name">
                            </td>
                            <td class="align-middle text-center">{{equipment.template.name}}</td>
                            <!-- <td class="align-middle text-center">{{getRecentOrder(equipment).id}}</td>
                            <td class="align-middle text-center">{{getRecentOrder(equipment).guest.name}}</td>
                            <td class="align-middle text-center">{{convertDate(getRecentOrder(equipment).created_at)}}</td> -->
                            <td class="align-middle text-center">
                                <button type="button" class="btn btn-primary" data-toggle="modal" :data-target="'#checkEquipment' + equipment.id">
                                    Tìm thấy đồ
                                </button>
                                <!-- <button type="button" class="btn btn-danger" @click="deleteEquipment(equipment, index)">
                                    <span class="fa fa-trash"></span>
                                </button> -->
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
                                                                <!-- <div>
                                                                    <span v-bind:class="starClass(1, equipment.condition)"></span>
                                                                    <span v-bind:class="starClass(2, equipment.condition)"></span>
                                                                    <span v-bind:class="starClass(3, equipment.condition)"></span>
                                                                    <span v-bind:class="starClass(4, equipment.condition)"></span>
                                                                    <span v-bind:class="starClass(5, equipment.condition)"></span>
                                                                </div> -->
                                                            </td>
                                                            <td class="text-center align-middle">
                                                                <!-- <div v-bind:id="'condition-' + equipment.id">
                                                                    <div class="starrating risingstar d-flex justify-content-center flex-row-reverse">
                                                                        <input type="radio" v-bind:id="'star5-' + equipment.id" value="5"  v-model="recentOrderInfos[equipment.id].condition_received" /><label :for="'star5-' + equipment.id" @mouseleave="normalText(equipment.id)" @mouseover="changeText(equipment.id, 'Hoàn hảo')" title="5 star">5</label>
                                                                        <input type="radio" v-bind:id="'star4-' + equipment.id" value="4"  v-model="recentOrderInfos[equipment.id].condition_received" /><label :for="'star4-' + equipment.id" @mouseleave="normalText(equipment.id)" @mouseover="changeText(equipment.id, 'Tốt')" title="4 star">4</label>
                                                                        <input type="radio" v-bind:id="'star3-' + equipment.id" value="3"  v-model="recentOrderInfos[equipment.id].condition_received" /><label :for="'star3-' + equipment.id" @mouseleave="normalText(equipment.id)" @mouseover="changeText(equipment.id, 'Bình thường')" title="3 star">3</label>
                                                                        <input type="radio" v-bind:id="'star2-' + equipment.id" value="2"  v-model="recentOrderInfos[equipment.id].condition_received" /><label :for="'star2-' + equipment.id" @mouseleave="normalText(equipment.id)" @mouseover="changeText(equipment.id, 'Không tốt')" title="2 star">2</label>
                                                                        <input type="radio" v-bind:id="'star1-' + equipment.id" value="1"  v-model="recentOrderInfos[equipment.id].condition_received" /><label :for="'star1-' + equipment.id" @mouseleave="normalText(equipment.id)" @mouseover="changeText(equipment.id, 'Kém')" title="1 star">1</label>
                                                                    </div>
                                                                    <div class="d-flex justify-content-center">
                                                                        <p v-bind:id="'scoreDescription-' + equipment.id">{{ scoreDescriptions[equipment.id] }}</p>
                                                                    </div>
                                                                </div> -->
                                                            </td>
                                                            <td class="text-center">
                                                                <textarea class="form-control" name="note" cols="10"></textarea>
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
    props:['lostEquipments'],
    data(){
        return {
            mess: 'Hello world',
            active:1
        }
    }
}
</script>