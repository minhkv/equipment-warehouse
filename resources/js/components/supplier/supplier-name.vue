<template>
    <div>{{ displaySupplierName() }}</div>
</template>
<script>
export default {
    props: ["equipment"],
    methods: {
        displaySupplierName() {
            if (this.equipment.supplier) {
                return this.equipment.supplier.name;
            } else if (this.equipment.supplier_name) {
                return this.equipment.supplier_name;
            } else {
                return "";
            }
        },
    },
};
</script>
<style scoped>
</style>