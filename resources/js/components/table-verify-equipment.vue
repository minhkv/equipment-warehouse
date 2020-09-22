<template>
    <table class="table table-hover">
        <thead class="thead-light">
            <tr>
                <th class="text-center" scope="col" style="width: 5%;">Mã</th>
                <th class="text-center" scope="col" style="width: 20%;">Tình trạng trước khi mượn</th>
                <th class="text-center" scope="col" style="width: 25%;">Tình trạng sau khi mượn</th>
                <th class="text-center" scope="col" style="width: 25%;">Ghi chú</th>
                <th class="text-center" scope="col">Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="orderInfo in orderInfos" :key="orderInfo.id" :class="rowClass(orderInfo)">
                <th class="text-center align-middle" scope="row">
                    {{ orderInfo.equipment_id }}
                </th>
                <td class="text-center align-middle">
                    <equipment-condition :condition="orderInfo.condition_before"></equipment-condition>
                </td>
                <td class="text-center align-middle">
                    <div v-if="status <= 2" :id="orderInfo.equipment_id" >
                        <div class="dropdown">
                            <select v-model="orderInfo.condition_received" class="custom-select mx-0">
                                <option value='1'><equipment-condition :condition="1"></equipment-condition></option>
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
                    <textarea v-if="status <= 2" v-model="orderInfo.note" class="form-control" name="note" cols="10"></textarea>
                    <div v-else>{{ orderInfo.note }}</div>
                </td>
                <td class="text-center align-middle">
                    <div>
                        <div class="dropdown">
                            <select v-model="orderInfo.status" class="custom-select mx-0">
                                <option value='2'>Đang cho mượn</option>
                                <option value='1'>Đã nhận</option>
                                <option value='0'>Thất lạc</option>
                            </select>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</template>
<script>
export default {
    props: ['orderInfos', 'status'],
    methods: {
        rowClass(orderInfo) {
            return {
                'table-success': orderInfo.status == 1,
                'table-danger': orderInfo.status == 0
            };
        }
    }
}
</script>
<style scoped>

</style>