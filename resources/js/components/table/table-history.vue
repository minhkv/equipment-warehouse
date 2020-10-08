<template>
    <div>
        <div class="text-center">
            <h3>Lịch sử thiết bị</h3>
        </div>
        <div class="row pb-2">
            <div class="col-3">
                <selection-filter
                    :items="items"
                    :values="filterConfig.values"
                    :all="filterConfig.all"
                    :by="filterConfig.by"
                    @change="selectionFilter($event)"
                ></selection-filter>
            </div>
            <div class="col-3">

            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Mã đơn</th>
                    <th>Người mượn</th>
                    <th>Tình trạng</th>
                    <th>Trạng thái</th>
                    <th>Ngày mượn</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="info in filterItems" :key="info.id">
                    <td scope="row">{{ getOrder(info).id }}</td>
                    <td>{{ getOrder(info).guest_name }}</td>
                    <td>
                        <equipment-condition :condition="info.condition_received"></equipment-condition>
                    </td>
                    <td>
                        <info-status :status="info.status"></info-status>
                    </td>
                    <td>{{ getOrder(info).date_output|formatDateTime }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    props: ["items"],
    data() {
        return {
            filterConfig: {
                values: [
                    { name: "Đang cho mượn", value: "2" },
                    { name: "Thất lạc", value: "0" },
                    { name: "Đã nhận", value: "1" },
                ],
                all: { name: "Trạng thái", value: -1 },
                by: "status",
            },
            filterItems: {},
            displayedItems: []
        };
    },
    created() {
        this.init();
    },
    methods: {
        init() {
            this.displayedItems = this.items.sort(this.sortOrder);
        },
        selectionFilter(items) {
            this.filterItems = items;
        },
        getOrder(orderInfo) {
            return orderInfo.order_request_info.order;
        },
        sortOrder(a, b) {
            let dateA = new Date(this.getOrder(a).date_output);
            let dateB = new Date(this.getOrder(b).date_output);
            return dateB.getTime() - dateA.getTime();
        },
    },
};
</script>
<style scoped>
</style>