<template>
    <span :class="displayStatusClass()">{{status | formatOrderStatus}}
        <i v-if="error" class="fa fa-exclamation-circle text-danger"></i>
    </span>
</template>
<script>
export default {
    props: ['status', 'error'],
    methods: {
        displayStatusClass() {
            return {
                'badge': true, 
                'badge-pill':true, 
                'badge-danger': this.status == -1,
                'badge-warning': this.status == 0,
                'badge-primary': this.status > 0 && status < 4,
                'badge-success': this.status == 4
            };
        }
    }
}
</script>