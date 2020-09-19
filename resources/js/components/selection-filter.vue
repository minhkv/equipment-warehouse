<template>
    <select v-model="model" @change="filter()" class="custom-select mx-0 cursor-pointer">
        <option v-if="all" :value="all.value">{{ all.name }}</option>
        <option v-for="v in values" :key="v.value" :value='v.value'>{{ v.name }}</option>
    </select>
</template>
<script>
export default {
    props: ['default', 'items', 'values', 'by', 'all'],
    created() {
        this.init();
    },
    watch: {
        items: function() {
            this.update();
        }
    },
    data() {
        return {
            model: '',
            displayedItems: []
        };
    },
    methods: {
        init() {
            this.model = -1;
            if(this.all) {
                this.model = this.all.value;
            }
            if(this.default)
                this.model = this.default;
            this.filter();
        },
        update() {
            this.filter();
        },
        filter() {
            if(this.model == this.all.value) {
                this.displayedItems = this.items;
            } else {
                this.displayedItems = this.items.filter(x => this.getAtt(x, this.by) == this.model);
            }
            this.sendEvent();
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
        sendEvent() {
            console.log('send filter ' + this.by);
            this.$emit('change', this.displayedItems);
        }
    }
}
</script>
<style scoped>

</style>