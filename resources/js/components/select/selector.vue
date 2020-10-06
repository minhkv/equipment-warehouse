<template>
    <div class="form-group">
        <label v-if="title">{{title}}</label>
        <select
            v-bind:value="value"
            v-on:input="$emit('input', $event.target.value)"
            class="form-control"
        >
            <option
                v-for="item in items"
                :key="item.id"
                :value="getAtt(item, valueAtt)"
            >{{getAtt(item, labelAtt)}}</option>
        </select>
    </div>
</template>
<script>
import ObjectMixin from '../../mixins/ObjectMixin';
export default {
    mixins: [ObjectMixin],
    props: ["title", "items", "labelAtt", "valueAtt", "value"],
    data() {
        return {};
    },
    methods: {
        
    },
};
</script>
<style scoped>
</style>