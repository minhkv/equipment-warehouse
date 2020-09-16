<template>
    <span :class="displayStatusClass(status)">
        {{status|formatInfoStatus}}
    </span>
</template>
<script>
export default {
    props: ['status'],
    data() {
        return {

        };
    },
    methods: {
        displayStatusClass(status) {
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