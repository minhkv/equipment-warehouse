<template>
    <input v-bind:value="format(value)" v-on:input="sendEvent($event)"  :placeholder="placeholder" type="text" class="form-control"/>
</template>
<script>
export default {
    props: ["value", "placeholder"],
    methods: {
        format(value) {
            let numberFormatter = new Intl.NumberFormat();
            let result = numberFormatter.format(value);
            if(result == "NaN") return 0;
            return result;
        },
        removeComma(value) {
            let splits = value.split(',');
            return splits.join('');
        },
        sendEvent(e) {
            this.$emit('input', this.removeComma(e.target.value));
        }
    }
};
</script>