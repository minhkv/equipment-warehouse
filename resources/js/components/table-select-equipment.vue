<template>
    <div>
        <div class="row">
            <div class="dropdown col-3">
                <!-- Select -->
                <selection-filter
                    :items="items"
                    :values="filterConfig.values"
                    :all="filterConfig.all"
                    :by="filterConfig.by"
                    @change="selectionFilter($event)"
                ></selection-filter>
            </div>
            <div class="col-8">
                <!-- Search -->
                <search-input :items="filterItems" :by="['name']" @change="searchInput($event)"></search-input>
            </div>
        </div>
        <table class="table mt-2">
            <thead class="thead-light">
                <tr>
                    <th class="text-center" scope="col" width="10%"></th>
                    <th class="text-center" scope="col" width="45%">Tên thiết bị</th>
                    <th class="text-center" scope="col" width="15%">Trong kho</th>
                    <th class="text-center" scope="col" width="15%">Yêu cầu</th>
                    <th class="text-center" scope="col" width="15%"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="template in paginateItems" :key="template.id" :class="rowClass(template)">
                    <th class="text-center" scope="row"><img :src="template.image" height=40 :alt="template.name"></th>
                    <td class="align-middle text-center">{{ template.name }}</td>
                    <td class="align-middle text-center">{{ template.equipments.length }}</td>
                    <td class="align-middle text-center">
                        <input 
                        class="form-control" 
                        v-if="buttonDisabled[template.id]"
                        type="number" 
                        name="amount" 
                        min='0' 
                        :max='template.equipments.length' 
                        v-model="getSelectedTemplate(template.id).amount"
                        @change="sendEvent()"
                        >
                        <div v-if="notInclude[template.id]">{{notInclude[template.id].amount}}</div>
                    </td>

                    <td class="align-middle text-center">
                        <button 
                        :disabled="buttonDisabled[template.id] || notInclude[template.id]" 
                        v-on:click="add(template)" 
                        type="button" 
                        class="btn btn-success btn-sm" 
                        >
                            <span class="fa fa-plus"></span>
                        </button>
                        <button 
                        :disabled="!buttonDisabled[template.id]" 
                        @click="remove(template)" 
                        type="button" 
                        class="btn btn-danger btn-sm">
                            <span class="fa fa-minus"></span>
                        </button>
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
export default {
    props: ['items', 'categories', 'selectedItems'],
    data() {
        return {
            buttonDisabled: {},
            notInclude: {},
            selectedTemplates: [],
            filterConfig: {
                values: [],
                all: { name: "Loại thiết bị", value: 0 },
                by: "category_id",
            },
            filterItems: [],
            searchItems: [],
            paginateItems: [],
        };
    },
    created() {
        this.init();
    },
    methods: {
        init() {
            // this.initSelectedTemplates();
            this.initButton();
            this.initFilter();
        },
        initSelectedTemplates() {
            let app = this;
            this.selectedItems.forEach((item) => {
                app.add(item);
            });
        },
        initButton() {
            let app = this;
            this.selectedItems.forEach(function(item) {
                Vue.set(app.notInclude, item.id, item);
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
        selectionFilter(items) {
            this.filterItems = items;
        },
        searchInput(items) {
            this.searchItems = items;
        },
        pagination(items) {
            this.paginateItems = items;
        },
        rowClass(template) {
            return {
                
            };
        },
        getSelectedTemplate(template_id) {
            for(let i in this.selectedTemplates) {
                if(this.selectedTemplates[i].id == template_id) {
                    return this.selectedTemplates[i];
                }
            }
        },
        add(template) {
            this.addEquipment(template);
            this.disableButton(template.id);
            this.sendEvent();
        },
        remove(template) {
            this.removeEquipmentById(template.id);
            this.enableButton(template.id);
            this.sendEvent();
        },
        addEquipment(template) {
            let newTemplate = Object.assign({}, template, {
                amount: template.amount || '0',
                maxAmount: template.maxAmount || template.equipments.length,
            });
            this.selectedTemplates.push(newTemplate);
        },
        removeEquipmentById(id) {
            let index = this.selectedTemplates.findIndex(x => x.id == id);
            this.selectedTemplates.splice(index, 1);
        },
        enableButton(template_id) {
            Vue.set(this.buttonDisabled, template_id, false);
        },
        disableButton(template_id) {
            Vue.set(this.buttonDisabled, template_id, true);
        },
        sendEvent() {
            this.$emit('change', this.selectedTemplates);
        }
    }
}
</script>
<style scoped>

</style>