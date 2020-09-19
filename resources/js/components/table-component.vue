<template>
    <table class="table">
        <thead>
            <tr>
                <th v-for="(col, index) in columns" :key="index">{{col.title}}</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in items" :key="item.id">
                <td v-for="(col, index) in columns" :key="index">
                    <div v-if="col.template" :is="col.template">
                        {{ getCell(item, col) }}
                    </div>
                    <div v-else>
                        {{ getCell(item, col) }}
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</template>
<script>
export default {
    props: ['items', 'columns'],
    data() {
        return {
            
        };
    },
    methods: {
        getCell(item, col) {
            return this.getAtt(item, col.attribute);
        }, 
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