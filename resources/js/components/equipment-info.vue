<template>
    <div class="col-12 mx-auto">
        <div class="row">
            <label class="col-3 text-left">
                <strong><i class="fa fa-barcode"></i> Mã</strong>
            </label>
            <label class="col-3 text-left">
                {{ equipment.id }}
            </label>
        </div>
        <div class="row">
            <label class="col-3 text-left">
                <strong> Tên</strong>
            </label>
            <label class="col-3 text-left">
                {{ equipment.name }}
            </label>
        </div>
        <div class="row">
            <label class="col-3 text-left">
                <strong><i class="fa fa-calendar"></i> Ngày nhập</strong>
            </label>
            <label class="col-3 text-left">
                {{ equipment.input_date|formatDate }}
            </label>
        </div>
        <div class="row">
            <label class="col-3 text-left">
                <strong><i class="fa fa-money"></i> Giá nhập</strong>
            </label>
            <label class="col-3 text-left">
                {{ equipment.price|formatEquipmentPrice }}
            </label>
        </div>
        <div class="row">
            <label class="col-3 text-left">
                <strong><i class="fa fa-building"></i> Nhà cung cấp</strong>
            </label>
            <label class="col-3 text-left">
                <supplier-name :equipment="equipment"></supplier-name>
            </label>
        </div>
        <div class="row">
            <label class="col-3 text-left">
                <strong>Tình trạng</strong>
            </label>
            <label class="col-3 text-left">
                <equipment-condition :condition="equipment.condition"></equipment-condition>
            </label>
        </div>
        <div class="row">
            <label class="col-3 text-left">
                <strong>Trạng thái</strong>
            </label>
            <label class="col-3 text-left">
                <equipment-status :status="equipment.status"></equipment-status>
            </label>
        </div>
        <div class="row">
            <label class="col-3 text-left">
                <strong>Ghi chú</strong>
            </label>
            <label class="col-3 text-left">
                {{ equipment.note }}
            </label>
        </div>
    </div>
</template>
<script>
export default {
    props: ['equipment']
}
</script>
<style scoped>

</style>