<template>
    <span :class="displayEquipmentStatusClass(status)" data-toggle="popover" :data-content="popoverContent">
        {{status|formatEquipmentStatus}}
    </span>
</template>
<script>
export default {
    props: ['status', 'popoverContent'],
    data() {
        return {

        };
    },
    methods: {
        displayEquipmentStatusClass(status) {
            return {
                'cursor-pointer': true,
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