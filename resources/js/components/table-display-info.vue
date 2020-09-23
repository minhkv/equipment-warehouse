<template>
    <table class="table mt-2 table-hover">
        <thead class="thead-light">
            <tr>
                <th class="text-center" scope="col" width="5%">Mã</th>
                <th class="text-center" scope="col" width="10%"></th>
                <th class="text-center" scope="col" width="20%">Tên thiết bị</th>
                <th class="text-center" scope="col" width="10%">Số lượng</th>
                <th class="text-center" scope="col" width="10%">Yêu cầu</th>
                <th class="text-center" scope="col" width="10%">Cho mượn</th>
                <th v-if="status >= 2" class="text-center" scope="col" width="10%">Đã trả</th>
                <th v-if="status >= 2" class="text-center" scope="col" width="10%">Thất lạc</th>
                <th class="text-center" scope="col" width="10%"></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="info in items" :key="'arise' + info.id" :class="rowClass(info)">
                <th class=" align-middle text-center" scope="row">{{info.id}}</th>
                <td class="align-middle text-center"><img :src="info.template.image" height=40 :alt="info.template.name"></td>
                <td class="align-middle text-center">{{ info.template.name }}</td>
                <td class="align-middle text-center">{{ info.template.equipments.length }}</td>
                <td class="align-middle text-center">{{ info.amount }}</td>
                <td class="align-middle text-center">
                    {{ getBorrowedAmountByInfo(info) }}
                </td>
                <td v-if="status >= 2" class="align-middle text-center font-weight-bold">
                    {{ getReceivedAmount(info) }}
                </td>
                <td v-if="status >= 2" :class="cellLostClass(info)">
                    {{ getLostAmount(info) }}
                </td> 
                <td class="align-middle text-center">
                    <div v-if="status > 0" >
                        <button v-if="status <= 1" type="button" class="btn btn-primary btn-sm" data-toggle="modal" :data-target="'#addEquipment-' + info.template.id">
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
</template>
<script>
export default {
    props: ['status', 'items'],
    methods: {
        rowClass(info) {
            return {
                'cursor-pointer': true,
                'table-success': 
                    this.status >= 2 &&
                    this.getBorrowedAmountByInfo(info) > 0 &&
                    (this.getBorrowedAmountByInfo(info) == 
                    this.getReceivedAmount(info) + 
                    this.getLostAmount(info))
            };
        },
        cellLostClass(info) {
            return {
                'align-middle': true, 
                'text-center': true, 
                'font-weight-bold': true, 
                'bg-danger': this.getLostAmount(info) > 0, 
                'text-light': this.getLostAmount(info) > 0
                };
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

</style>