<template>
    <div class="form-group">
        <select class="form-control">
            <option v-for="item in items" :key="item.id" :value="getAtt(item, valueAtt)">{{getAtt(item, labelAtt)}}</option>
        </select>
    </div>
</template>
<script>
export default {
    props: ['items', 'labelAtt', 'valueAtt'],
    methods: {
        getAtt(item, att) {
            let splitAtt = att.split('.');
            if(splitAtt.length > 1) {
                return this.getNestedAtt(item, splitAtt);
            }
            return item[att];
        },
        getNestedAtt(item, atts) {
            let value, i = 0;
            atts.forEach(att => {
                if(i == 0) {
                    value = item[att];
                } else {
                    value = value[att];
                }
                i++;
            });
            return value;
        },
    }
}
</script>
<style scoped>

</style>