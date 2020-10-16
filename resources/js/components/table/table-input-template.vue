<template>
    <div>
        <div class="row">
            <div class="dropdown col-3">
                <!-- Select -->
                <selection-filter
                    :items="displayedItems"
                    :values="filterConfig.values"
                    :all="filterConfig.all"
                    :by="filterConfig.by"
                    @change="selectionFilter($event)"
                ></selection-filter>
            </div>
            <div class="col-8">
                <!-- Search -->
                <search-input :items="filterItems" :by="['template.name', 'template.id']" @change="searchInput($event)"></search-input>
            </div>
        </div>
        <table class="table mt-2">
            <thead class="thead-light">
                <tr>
                    <th class="text-center" scope="col" width="10%">Mã</th>
                    <th class="text-center" scope="col" width="10%"></th>
                    <th class="text-center" scope="col" width="25%">Tên thiết bị</th>
                    <th class="text-center" scope="col" width="11%">Số lượng</th>
                    <th class="text-center" scope="col" width="15%">Giá nhập</th>
                    <th class="text-center" scope="col" width="15%">Bảo hành</th>
                    <th class="text-center" scope="col" width="10%"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in paginateItems" :key="item.id">
                    <th class="text-center" scope="row">
                        {{item.template.id}}
                    </th>
                    <th class="text-center" scope="row">
                        <img :src="item.template.image" height=40 :alt="item.template.name">
                    </th>
                    <td class="align-middle text-center">{{ item.template.name }}</td>
                    <td class="align-middle text-center">
                        <input @change="changeInput($event)" v-if="itemSelected(item)" v-model="item.amount" type="number" class="form-control">
                    </td>
                    <td class="align-middle text-center">
                        <number-input @change="changeInput($event)" v-if="itemSelected(item)" v-model="item.price" ></number-input>
                    </td>
                    <td class="align-middle text-center">
                        <input @change="changeInput($event)" v-if="itemSelected(item)" v-model="item.warranty" type="date" class="form-control">
                    </td>
                    <td class="align-middle text-center">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input @change="updateSelectedItems($event, item)" :checked="itemSelected(item)" class="form-check-input" type="checkbox"> 
                            </label>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- Paginator -->
        <div class="row justify-content-center">
            <pagination :items="searchItems" :per="6" @change="pagination($event)"></pagination>
        </div>
    </div>
</template>
<script>
import LocalStorageMixin from '../../mixins/LocalStorageMixin';
export default {
    mixins: [LocalStorageMixin],
    props: ['templates', 'categories', 'newItem'],
    data() {
        return {
            filterConfig: {
                values: [],
                all: { name: "Loại thiết bị", value: 0 },
                by: "template.category_id",
            },
            filterItems: [],
            searchItems: [],
            paginateItems: [],
            displayedItems: [],
            selectedItems: [],
            atts: ['selectedItems']
        };
    },
    created() {
        this.init();
        this.sendEvent();
    },
    watch: {
        templates() {
            console.log('refresh');
            this.initRequest();
        },
        newItem() {
            console.log('new');
            this.addTemplate(this.newItem);
        },
        selectedItems() {
            this.store();
        }
    },
    methods: {
        init() {
            this.initRequest();
            this.load();
            this.initFilter();
        },
        initRequest() {
            this.displayedItems = this.templates.map(tem => {
                return {
                    template: tem,
                    amount: 0,
                    price: 0,
                    warranty: ''
                };
            });
        },
        initFilter() {
            this.categories.forEach((cate) => {
                this.filterConfig.values.push({
                    name: cate.name,
                    value: cate.id,
                });
            });
        },
        load() {
            this.loadStorage(this.atts);
            let items = this.selectedItems;
            let app = this;
            items.forEach(item => {
                let index = app.displayedItems.findIndex(i => i.template.id == item.template.id);
                Vue.set(app.displayedItems, index, item);
            });
        },
        store() {
            this.storeStorage(this.atts);
        },
        selectionFilter(items) {
            this.filterItems = items;
        },
        searchInput(items) {
            this.searchItems = items;
        },
        pagination(items) {
            this.paginateItems = items;
        },
        addTemplate(item) {
            this.selectedItems.push(item);
        },
        removeTemplate(item) {
            let index = this.selectedItems.findIndex(i => i.template.id == item.id);
            this.selectedItems.splice(index, 1);
        },
        add(item) {
            this.addTemplate(item);
            this.sendEvent();
        },
        remove(item) {
            this.removeTemplate(item);
            this.sendEvent();
        },
        updateSelectedItems(e, item) {
            if(e.srcElement.checked) {
                this.add(item);
            } else {
                this.remove(item);
            }
            console.log('store');
        },
        changeInput(e) {
            this.sendEvent();
            this.store();
        },
        itemSelected(item) {
            return this.selectedItems.some(i => item.template.id == i.template.id);
        },
        sendEvent() {
            this.$emit('change', this.selectedItems);
        }
    },
}
</script>
<style scoped>

</style>