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
import ObjectMixin from '../../mixins/ObjectMixin';
export default {
    mixins: [ObjectMixin],
    props: ['items', 'columns'],
    data() {
        return {
            
        };
    },
    methods: {
        getCell(item, col) {
            return this.getAtt(item, col.attribute);
        }, 
    }
}
</script>
<style scoped>

</style>