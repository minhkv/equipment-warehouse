<template>
    <select v-model="model" @change="change" class="custom-select mx-0">
        abc
        <option selected value='1'><equipment-condition :condition="1"></equipment-condition></option>
        <option value='2'><equipment-condition :condition="2"></equipment-condition></option>
        <option value='0'><equipment-condition :condition="0"></equipment-condition></option>
    </select>
</template>
<script>
export default {
    props: ['initValue'],
    data() {
        return {
            model: ''
        };
    },
    created() {
        this.init();
    },
    methods: {
        init() {
            this.model = this.initValue;
        },
        change() {
            this.sendEvent();
        },
        sendEvent() {
            this.$emit('change', this.model);
        }
    }
}
</script>
<style scoped>

</style>