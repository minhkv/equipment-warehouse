<template>
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
            <tr v-for="equipment in requestInfo.template.equipments" :key="equipment.id" :class="rowClass(equipment)">
                <th class="text-center align-middle" scope="row">{{ equipment.id }}</th>
                <td class="text-center align-middle">{{ equipment.price|formatEquipmentPrice }}</td>
                <td class="text-center align-middle">
                    <supplier-name :equipment="equipment"></supplier-name></td>
                <td class="text-center align-middle">
                    <equipment-condition :condition="equipment.condition"></equipment-condition>
                </td>
                <td class="align-middle text-center">
                    <equipment-status-popover :equipment="equipment"></equipment-status-popover>
                </td>
                <td>{{equipment.note}}</td>
                <td class="align-middle">
                    <button :disabled="disablePlusButton(equipment)" @click="addEquipment(equipment)" class="btn btn-success btn-sm"><span class="fa fa-plus"></span></button>
                    <button :disabled="disableMinusButton(equipment)" @click="removeEquipment(equipment)" class="btn btn-danger btn-sm"><span class="fa fa-minus"></span></button>
                </td>
            </tr>
        </tbody>
    </table>
</template>
<script>
export default {
    props: ['requestInfo'],
    data() {
        return {
            displayedInfo: []
        };
    },
    created() {
        this.init();
    },
    methods: {
        init() {
            this.displayedInfo = Object.assign({}, this.displayedInfo, this.requestInfo);
        },
        rowClass(equipment) {
            return {};
        },
        equipmentSelected(equipment) {
            let selected = this.displayedInfo.order_infos.some(info => {
                return info.equipment_id == equipment.id;
            });
            return selected;
        },
        disablePlusButton(equipment) {
            return this.equipmentSelected(equipment) || equipment.status != 1;
        },
        disableMinusButton(equipment) {
            return !this.equipmentSelected(equipment);
        },
        addEquipment(equipment) {
            this.addOrderInfo(equipment);
            this.sendEvent();
        },
        addOrderInfo(equipment) {
            this.displayedInfo.order_infos.push({
                'equipment_id': equipment.id,
                'condition_before': equipment.condition
            });
        },
        removeEquipment(equipment) {
            this.removeOrderInfo(equipment);
            this.sendEvent();
        },
        removeOrderInfo(equipment) {
            let index = this.displayedInfo.order_infos.findIndex(info => {
                info.equipment_id == equipment.id
            });
            if (index != -1) {
                this.displayedInfo.order_infos.splice(index, 1);
            }
        },
        sendEvent() {
            this.$emit('change', this.displayedInfo.order_infos);
        }
    }
}
</script>
<style scoped>

</style>