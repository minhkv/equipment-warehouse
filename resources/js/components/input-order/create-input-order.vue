<template>
    <div class="container">
        <form id="msform">
            <div class="track">
                <div :class="{'step': true, 'active': step >= 0}">
                    <span class="icon"> <i class="fa fa-info"></i> </span>
                    <span class="text">Thông tin đơn nhập</span>
                </div>
                <div :class="{'step': true, 'active': step >= 1}">
                    <span class="icon"> <i class="fa fa-check"></i> </span>
                    <span class="text">Xác nhận</span>
                </div>
            </div>
            <fieldset>
                <div v-show="step==0">
                    <h2 class="fs-title">Thông tin đơn nhập</h2>
                    <div class="form-group row">
                        <label for="dateInput" class="col-3 col-form-label text-left">Ngày nhập</label>
                        <div class="col-9">
                            <input v-model="dateInput" class="form-control" type="date" id="dateBorrowed">
                        </div>
                    </div>
                </div>
                <div v-show="step==1">
                    <h2 class="fs-title">Xác nhận</h2>
                    <div class="row">
                        <label class="col-3 text-left">Ngày nhập</label>
                        <label class="col-9 text-left">{{ dateInput | formatDate }}</label>
                    </div>
                </div>
                <table class="table mt-2 templateTable">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center" scope="col" width="10%">Mã</th>
                            <th class="text-center" scope="col" width="25%">Tên thiết bị</th>
                            <th class="text-center" scope="col" width="25%">Nhà cung cấp</th>
                            <th class="text-center" scope="col" width="11%">Số lượng</th>
                            <th class="text-center" scope="col" width="15%">Giá nhập</th>
                            <th class="text-center" scope="col" width="15%">Bảo hành</th>
                            <th class="text-center" scope="col" width="5%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in paginateItems" :key="item.template.id">
                            <th class="align-middle text-center" scope="row">{{item.template.id}}</th>
                            <td class="align-middle text-center">{{item.template.name}}</td>
                            <td class="align-middle text-center">
                                <autocomplete-input @change="changeSupplier($event, item)" v-if="displayInput()" :items="suppliers" :value="item.supplier_name" name-attribute="name" placeholder="Nhà cung cấp"></autocomplete-input>
                                <div v-if="displayText()">{{item.supplier_name}}</div>
                            </td>
                            <td class="align-middle text-center">
                                <input @change="store()" v-if="displayInput()" type="number" min="0" class="form-control" v-model="item.amount">
                                <div v-if="displayText()">{{item.amount}}</div>
                            </td>
                            <td class="align-middle text-center">
                                <number-input @change="store()" v-if="displayInput()" v-model="item.price"></number-input>
                                <div v-if="displayText()">{{item.price | formatPrice}}</div>
                            </td>
                            <td class="align-middle text-center">
                                <input @change="store()" v-if="displayInput()" type="date" class="form-control" v-model="item.warranty">
                                <div v-if="displayText()">{{item.warranty | formatDate}}</div>
                            </td>
                            <td class="align-middle text-center">
                                <button @click="removeItem(item)" v-if="displayInput()" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row justify-content-center">
                    <!-- Paginator -->
                    <pagination @change="pagination($event)" :items="selectedItems" per="6"></pagination>
                </div>
                <div v-if="step==0">
                    <div class="form-group">
                        <button class="btn btn-success" type="button" data-toggle="modal" data-target="#addEquipment">
                            Chọn thiết bị
                        </button>
                    </div>
                    <div class="form-group">
                        hoặc 
                        <button class="btn btn-secondary btn-sm" type="button" data-toggle="modal" data-target="#createEquipment">
                            Tạo thiết bị
                        </button>
                    </div>
                </div>

                <button v-show="step > 0" type="button" class="btn btn-secondary next action-button" @click="previousStep()">Quay lại</button>
                <button v-show="step == 0" type="button" class="btn btn-primary previous action-button" @click="nextStep()">Tiếp tục</button>
                <button @click="submitInputOrder()" v-show="step == 1" type="button" class="btn btn-success previous action-button" :disabled="submit">Hoàn tất</button>
            </fieldset>
        </form>
        <modal-component id="addEquipment" title="Thêm thiết bị" size="xl">
            <table-input-template @change="updateSelectedTemplates($event)" :templates="componentTemplates" :categories="categories" :newItem="newItem"></table-input-template>
            <template v-slot:footer>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Xong</button>
            </template>
        </modal-component>
        <modal-component id="createEquipment" title="Tạo mẫu mới" size="xl">
            <template-form @change="createTemplate($event)" :categories="categories"></template-form>
        </modal-component>
    </div>
</template>
<script>
import RequestMixin from '../../mixins/RequestMixin';
import LocalStorageMixin from '../../mixins/LocalStorageMixin';
export default {
    mixins: [RequestMixin, LocalStorageMixin],
    props: [
        'stocker_id', 
        'suppliers', 
        'templates', 
        'categories', 
        'templateCreateUrl', 
        'storeInputOrderUrl',
        'inputOrderIndexUrl',
    ],
    data() {
        return {
            step: 0,
            dateInput: '',
            submit: false,
            selectedItems: [],
            paginateItems: [],
            newItem: {},
            componentTemplates: {},
            atts: ['dateInput', 'selectedItems']
        };
    },
    created() {
        this.init();
    },
    watch: {
        supplier_name() {
            this.store();
        },
        supplier_id() {
            this.store();
        },
        dateInput() {
            this.store();
        }
    },
    methods: {
        init() {
            this.componentTemplates = this.templates;
            this.loadStorage(this.atts);
        },
        store() {
            this.storeStorage(this.atts);
        },
        validate() {
            let app = this;
            if(this.step == 0) {
                if(!this.dateInput) {
                    alert('Bạn chưa nhập ngày');
                    return false;
                }
            } else if(this.step == 1) {
                if(this.selectedItems.length == 0) {
                    alert("Bạn chưa chọn thiết bị");
                    return false;
                }
                let checkItems = this.selectedItems.every(item => app.checkInfo(item) == true);
                if(!checkItems) return false;
            }
            return true;
        },
        checkInfo(item) {
            if(item.amount == 0) {
                alert('Số lượng của thiết bị ' + item.template.name + ' phải > 0');
                return false;
            }
            if(item.price == 0) {
                alert('Giá của thiết bị ' + item.template.name + ' phải > 0');
                return false;
            }
            if(!item.warranty) {
                alert('Bạn chưa nhập ngày bảo hành của thiết bị ' + item.template.name);
                return false;
            }
            return true;
        },
        nextStep() {
            if(!this.validate()) return;
            if(this.step < 2)
                this.step ++;
        },
        previousStep() {
            if(this.step > 0) {
                this.step --;
            }
        },
        submitInputOrder() {
            console.log('submit');
            this.submit = true;
            let data = {
                stocker_id: this.stocker_id,
                type: 2,
                supplier_id: this.supplier_id,
                supplier_name: this.supplier_name,
                dateInput: this.dateInput,
                selectedItems: this.selectedItems,
            };
            let app = this;
            this.sendRequest(this.storeInputOrderUrl, 'post', data, function(data) {
                console.log(data);
                window.location.replace(app.inputOrderIndexUrl);
            });
        },
        createTemplate(data) {
            console.log('createTemplate');
            let formData = new FormData();
            let app = this;
            let headers = {
                headers: {"Content-Type": "multipart/form-data",},
            };
            formData.append("name", data.name);
            formData.append("category_id", data.category_id);
            formData.append("imageFile", data.imageFile);
            this.sendRequest(this.templateCreateUrl, 'post', formData, this.updatePage);
        },
        updatePage(template) {
            console.log(template);
            let item = {
                template: template,
                amount: 0,
                price: 0,
                warranty: ''
            };
            this.newItem = item;
            this.componentTemplates.push(template);
        },
        updateSelectedTemplates(items) {
            this.selectedItems = items;
        },
        pagination(items) {
            this.paginateItems = items;
        },
        displayInput() {
            return this.step == 0;
        },
        displayText() {
            return this.step == 1;
        },
        changeSupplier(result, item){
            item.supplier_name = result.value.name;
            if(result.found) {
                item.supplier_id = result.value.id;
            } else {
                item.supplier_id = null;
            }
        },
        removeItem(item) {
            this.itemNeedToRemove = item;
            let index = this.selectedItems.findIndex(i => i.template.id == item.template.id);
            this.selectedItems.splice(index, 1);
        },
    }
}
</script>
<style scoped>
#msform fieldset {
    width: 100%;
    margin: auto;
}
</style>