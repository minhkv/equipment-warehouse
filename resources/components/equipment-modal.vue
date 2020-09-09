<template>
    <div class="container"></div>
</template>
<script>
export default {
    props: ['equipment'],
    data() {
        return {

        };
    },
    methods: {
        displayEquipmentStatusClass(status) {
            return {
                'badge': true, 
                'badge-pill':true, 
                'badge-danger': status == 0,
                'badge-success': status == 1,
                'badge-primary': status == 2
            };
        },
    }
};
</script>
<style scoped>
</style>