<template>
    <form class="my-2 my-lg-0 px-2">
        <div class="input-group">
            <input
                v-on:keyup="keyup"
                v-model="search"
                class="form-control mr-sm-2"
                type="search"
                :placeholder="holder"
            />
            <button class="btn btn-outline-primary my-2 my-sm-0" type="button">
                <span class="fa fa-search"></span>
            </button>
        </div>
    </form>
</template>

<script>
import ObjectMixin from '../mixins/ObjectMixin';
export default {
    mixins: [ObjectMixin],
    props: ['items', 'by', 'placeholder'],
    data() {
        return {
            search: '',
            holder: 'Tìm kiếm'
        };
    },
    created() {
        this.init();
    },
    watch: {
        items: function () {
            this.update();
        },
    },
    methods: {
        init() {
            if(this.placeholder) this.holder = this.placeholder;
            this.sendEvent();
        },
        update() {
            this.sendEvent();
        },
        normalizeSearchString(str) {
            return String(str).normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
        },
        searchItems() {
            let app = this;
            return this.items.filter(x => {
                let search = app.normalizeSearchString(this.search);
                let found = false;
                app.by.forEach(att => {
                    let value = app.normalizeSearchString(this.getAtt(x, att));
                    if(value.includes(search)) {
                        found = true;
                        return;
                    }
                });
                return found;
            });
        },
        sendEvent() {
            console.log('search');
            this.$emit('change', this.searchItems());
        },
        keyup(){
            this.sendEvent();
        },
    },
};
</script>
<style scoped>
</style>