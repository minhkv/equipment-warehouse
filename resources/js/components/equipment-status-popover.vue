<template>
    <equipment-status :status="equipment.status" :popoverContent="getPopoverContent()"></equipment-status>
</template>
<script>
export default {
    props: ['equipment'],
    data() {
        return {
        };
    },
    methods: {
        getPopoverContent() {
            if(this.equipment.status == 1) return;
            let info = this.getLastOrderInfo();
            if(info) {
                let order = this.getOrderByOrderInfo(info);
                return 'Mã đơn: ' + order.id + ', Người mượn: ' + order.guest_name;
            }
            return 'Không có thông tin';
        },
        getLastOrderInfo() {
            let infos = [];
            this.equipment.order_infos.forEach(function(info) {
                infos.push(info);
            });
            return infos.sort(this.sortOrderInfoByDateDesc)[0];
        },
        getOrderByOrderInfo(orderInfo) {
            return orderInfo.order_request_info.order;
        },
        sortOrderInfoByDateDesc(a, b) {
            let dateA = new Date(this.getOrderByOrderInfo(a).date_output);
            let dateB = new Date(this.getOrderByOrderInfo(b).date_output);
            return dateB.getTime() - dateA.getTime();
        }
    },
}
</script>