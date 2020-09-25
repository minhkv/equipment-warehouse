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
                        v-if="itemSelected(template)"
                        type="number" 
                        name="amount" 
                        min='0' 
                        :max='template.equipments.length' 
                        v-model="getSelectedTemplate(template.id).amount"
                        @change="sendEvent()"
                        >
                        <input 
                        class="form-control" 
                        v-else-if="itemDisabled(template)"
                        type="number" 
                        name="amount" 
                        min='0' 
                        :max='template.equipments.length' 
                        v-model="getDisabledTemplate(template.id).amount"
                        @change="sendEvent()"
                        >
                        <!-- <div v-if="itemDisabled(template)">{{getDisabledTemplate(template.id).amount}}</div> -->
                    </td>

                    <td class="align-middle text-center">
                        <button 
                        :disabled="disablePlusButton(template)" 
                        v-on:click="add(template)" 
                        type="button" 
                        class="btn btn-success btn-sm" 
                        >
                            <span class="fa fa-plus"></span>
                        </button>
                        <button 
                        :disabled="disableMinusButton(template)" 
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
    props: ['items', 'categories', 'disabledTemplates', 'templateNeedToRemove'],
    data() {
        return {
            selectedItems: [],
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
    watch: {
        templateNeedToRemove: function() {
            console.log('remove');
            if(this.templateNeedToRemove) {
                this.remove(this.templateNeedToRemove);
            }
        }
    },
    methods: {
        init() {
            this.initFilter();
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
            for(let i in this.selectedItems) {
                if(this.selectedItems[i].id == template_id) {
                    return this.selectedItems[i];
                }
            }
        },
        getDisabledTemplate(template_id) {
            for(let i in this.disabledTemplates) {
                if(this.disabledTemplates[i].id == template_id) {
                    return this.disabledTemplates[i];
                }
            }
        },
        add(template) {
            this.addTemplate(template);
            this.sendEvent();
        },
        
        remove(template) {
            this.removeTemplate(template.id);
            this.sendEvent();
        },
        addTemplate(template) {
            let temp = this.items.find(item => {
                return item.id == template.id;
            });
            let newTemplate = Object.assign({}, temp, {
                amount: template.amount || '0',
                maxAmount: template.maxAmount || template.equipments.length,
            });
            this.selectedItems.push(newTemplate);
        },
        updateTemplate(id, template) {
            let index = this.selectedItems.findIndex(x => x.id == id);
            // this.selectedItems[index];
        },
        removeTemplate(id) {
            let index = this.selectedItems.findIndex(x => x.id == id);
            if(index != -1)
                this.selectedItems.splice(index, 1);
            index = this.disabledTemplates.findIndex(x => x.id == id);
            if(index != -1)
                this.disabledTemplates.splice(index, 1);
        },
        enableButton(template_id) {
            Vue.set(this.buttonDisabled, template_id, false);
        },
        disableButton(template_id) {
            Vue.set(this.buttonDisabled, template_id, true);
        },
        itemSelected(item) {
            let selected = this.selectedItems.some(x => {
                return x.id == item.id;
            });
            return selected;
        },
        itemDisabled(item) {
            let disabled = this.disabledTemplates.some(x => {
                return x.id == item.id;
            });
            return disabled;
        },
        disablePlusButton(template) {
            return this.itemSelected(template) || this.itemDisabled(template);
        },
        disableMinusButton(template) {
            return !this.itemSelected(template) && !this.itemDisabled(template);
        },
        sendEvent() {
            console.log('send');
            let data = {
                origin: this.disabledTemplates,
                arise: this.selectedItems
            };
            this.$emit('change', data);
        }
    }
}
</script>
<style scoped>

</style>