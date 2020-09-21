<template>
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
</template>
<script>
export default {
    
}
</script>
<style scoped>

</style>