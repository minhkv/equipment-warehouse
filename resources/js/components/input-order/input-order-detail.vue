<template>
    <div>
        <div class="row">
            <label class="col-3 text-left">
                <strong><i class="fa fa-barcode"></i> Mã</strong>
            </label>
            <label class="col-3 text-left">
                {{ order.id }}
            </label>
        </div>
        <div class="row">
            <label class="col-3 text-left">
                <strong><i class="fa fa-building"></i> Nhà cung cấp</strong>
            </label>
            <label class="col-3 text-left">
                {{ order.supplier_name }}
            </label>
        </div>
        <div class="row">
            <label class="col-3 text-left">
                <strong><i class="fa fa-user"></i> Người nhập</strong>
            </label>
            <label class="col-3 text-left">
                {{ order.stocker.name }}
            </label>
        </div>
        <div class="row">
            <table class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th style="width: 5%;" class="align-middle text-center" scope="col">Mã</th>
                        <th style="width: 25%;" class="align-middle text-center" scope="col">Tên</th>
                        <th style="width: 10%;" class="align-middle text-center" scope="col">Số lượng</th>
                        <th style="width: 16%;" class="align-middle text-center" scope="col">Giá</th>
                        <th style="width: 16%;" class="align-middle text-center" scope="col">Bảo hành</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="cursor-pointer" v-for="requestInfo in order.order_request_infos" :key="requestInfo.id">
                        <th data-toggle="modal" :data-target="'#detail' + order.id" scope="row" class="align-middle text-center">{{requestInfo.id}}</th>
                        <td class="text-center align-middle">{{requestInfo.template.name}}</td>
                        <td class="text-center align-middle">{{requestInfo.amount}}</td>
                        <td class="text-center align-middle">{{requestInfo.price | formatPrice}}</td>
                        <td class="text-center align-middle">{{requestInfo.warranty}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
export default {
    props: ['order']
}
</script>
<style scoped>
table {
    font-size: 0.9em;
}
</style>