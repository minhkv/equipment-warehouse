<template>
    <div>
        <table class="table table-hover">
            <thead class="thead-light">
                <tr>
                    <th class="text-center" scope="col" style="width: 5%">Mã</th>
                    <th class="text-center" scope="col" style="width: 15%">Tên</th>
                    <th class="text-center" scope="col" style="width: 10%;">Tình trạng</th>
                    <th class="text-center" scope="col" style="width: 10%;">Trạng thái</th>
                    <th class="text-center" scope="col" style="width: 15%;">Ghi chú</th>
                    <th class="text-center" scope="col" style="width: 10%;"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="equipment in paginateItems" :key="equipment.id" :class="rowClass(equipment)">
                    <th class="text-center align-middle" scope="row">{{ equipment.id }}</th>
                    <td class="text-center align-middle">{{ equipment.name }}</td>
                    <td>
                        <equipment-condition :condition="equipment.condition"></equipment-condition>
                    </td>
                    <td class="align-middle text-center">
                        <equipment-status-popover :equipment="equipment"></equipment-status-popover>
                    </td>
                    <td>{{equipment.note}}</td>
                    <td class="align-middle">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" :disabled="disableCheckbox(equipment)" :checked="equipmentSelected(equipment)" @change="updateSelectedEquipment($event, equipment)"> 
                            </label>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row justify-content-center">
            <pagination @change="pagination($event)" :items="requestInfo.template.equipments" per="8"></pagination>
        </div>
    </div>
</template>
<script>
export default {
    props: ['requestInfo'],
    data() {
        return {
            displayedInfo: [],
            paginateItems: []
        };
    },
    created() {
        this.init();
    },
    watch: {
        requestInfo: function() {
            this.setDisplayedInfo();
        }
    },
    methods: {
        init() {
            this.setDisplayedInfo();
        },
        pagination(items) {
            this.paginateItems = items;
        },
        setDisplayedInfo() {
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
        equipmentNotAvailable(equipment) {
            return equipment.status != 1;
        },
        disableCheckbox(equipment) {
            return this.equipmentNotAvailable(equipment) && !this.equipmentSelected(equipment);
        },
        
        updateSelectedEquipment(e, equipment) {
            if(e.srcElement.checked) {
                this.addEquipment(equipment);
            } else {
                this.removeEquipment(equipment);
            }
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
                return info.equipment_id == equipment.id;
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