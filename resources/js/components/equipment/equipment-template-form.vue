<template>
    <div>
        <form id="msform">
            <div class="track">
                <div :class="{'step': true, 'active': step >= 0}">
                    <span class="icon"> <i class="fa fa-info"></i> </span>
                    <span class="text">Thông tin mẫu</span>
                </div>
                <div :class="{'step': true, 'active': step >= 1}">
                    <span class="icon"> <i class="fa fa-desktop"></i> </span>
                    <span class="text">Thêm thiết bị</span>
                </div>
                <div :class="{'step': true, 'active': step >= 2}">
                    <span class="icon"> <i class="fa fa-check"></i> </span>
                    <span class="text"> Xác nhận</span>
                </div>
            </div>
            <fieldset>
                <div v-show="step == 0">
                    <div class="text-center"><h2 class="fs-title">Thêm mẫu mới</h2></div>
                
                    <div class="form-group row">
                        <label class="col-3 col-form-label text-left">Tên mẫu thiết bị</label>
                        <input @change="store()" v-model="name" type="text" class="col-9 form-control" placeholder="Tên mẫu thiết bị">
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label text-left" for="equipmentCategory">Loại</label>
                        <selector v-model="category" :items="displayedCategories" labelAtt="name" valueAtt="id" class="col-9"></selector>
                    </div>
                    <div class="form-group row">
                        <label class="col-3 col-form-label text-left" for="equipmentImage">Hình ảnh</label>
                        <input v-on:change="handleFileUpload()" ref="imageFile" type="file" class="form-control-file col-9">
                    </div>
                </div>
                <div v-show="step==2">
                    <h2 class="fs-title">Xác nhận</h2>
                    <div class="row">
                        <label class="col-3 text-left">Tên mẫu thiết bị</label>
                        <label class="col-9 text-left">{{name}}</label>
                    </div>
                    <div class="row">
                        <label class="col-3 text-left">Loại</label>
                        <label class="col-9 text-left">{{ getCategoryName(category) }}</label>
                    </div>
                </div>
                <div v-show="step >= 1">
                    <table class="table table-hover mx-auto">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center" scope="col" style="width: 20%">Tên thiết bị</th>
                                <th class="text-center" scope="col" style="width: 15%;">Nhà cung cấp</th>
                                <th class="text-center" scope="col" style="width: 15%;">Giá nhập</th>
                                <th class="text-center" scope="col" style="width: 10%;">Ngày nhập</th>
                                <th class="text-center" scope="col" style="width: 10%;">Bảo hành</th>
                                <th class="text-center" scope="col" style="width: 15%;">Ghi chú</th>
                                <th class="text-center" scope="col" style="width: 5%;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(equipment, index) in equipments" :key="index" class="cursor-pointer" >
                                <th class="align-middle text-center" scope="row">
                                    <input @change="store()" v-model="equipment.name" v-if="displayInput()" type="text" class="form-control">
                                    <div v-if="displayText()">{{equipment.name}}</div>
                                </th>
                                <td class="align-middle text-center">
                                    <autocomplete-input @change="changeSupplier($event, equipment)" v-model="equipment.supplier_name" v-if="displayInput()" :items="suppliers" nameAttribute="name"></autocomplete-input>
                                    <div v-if="displayText()">{{equipment.supplier_name}}</div>
                                </td>
                                <td>
                                    <number-input @change="store()" v-model="equipment.price" v-if="displayInput()"></number-input>
                                    <div v-if="displayText()">{{equipment.price|formatPrice}}</div>
                                </td>
                                <th class="align-middle text-center" scope="row">
                                    <input @change="store()" v-model="equipment.input_date" v-if="displayInput()" type="date" class="form-control date-picker">
                                    <div v-if="displayText()">{{equipment.input_date | formatDate}}</div>
                                </th>
                                <td class="align-middle text-center">
                                    <input @change="store()" v-model="equipment.warranty" v-if="displayInput()" type="date" class="form-control date-picker">
                                    <div v-if="displayText()">{{equipment.warranty | formatDate}}</div>
                                </td>
                                <td class="align-middle text-center">
                                    <input @change="store()" v-model="equipment.note" v-if="displayInput()" type="text" class="form-control">
                                    <div v-if="displayText()">{{equipment.note}}</div>
                                </td>
                                <td class="align-middle text-center">
                                    <button @click="removeEquipmentInput(index)" v-if="displayInput()" type="button" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row justify-content-center">
                        <button @click="addEquipmentInput()" v-if="displayInput()" type="button" class="btn btn-success">
                            Thêm thiết bị
                        </button>
                    </div>
                </div>
                <button v-show="step > 0" type="button" class="btn btn-secondary next action-button" @click="previousStep()">Quay lại</button>
                <button v-show="step < 2" type="button" class="btn btn-primary previous action-button" @click="nextStep()">Tiếp tục</button>
                <button @click="submitTemplate()" v-show="step == 2" type="button" class="btn btn-success previous action-button" :disabled="submitted">Hoàn tất</button>
            </fieldset>
        </form>
    </div>
</template>
<script>
import LocalStorageMixin from '../../mixins/LocalStorageMixin';
export default {
    mixins: [LocalStorageMixin],
    props: ['categories', 'suppliers'],
    data() {
        return {
            step: 0,
            name: '',
            category: 1,
            imageFile: {},
            displayedCategories: [],
            equipments: [],
            submitted: false,
            atts: ['name', 'category', 'imageFile', 'equipments']
        };
    },
    created() {
        this.init();
    },
    watch: {
        imageFile() {
            this.store();
        },
        category() {
            this.store();
        },
    },
    methods: {
        init() {
            this.displayedCategories = this.categories;
            this.loadStorage(this.atts);
        },
        resetForm() {
            this.name = '';
            this.category = 1;
            this.imageFile = {};
        },
        store() {
            this.storeStorage(this.atts);
        },
        validate() {
            if(this.step == 0 || this.step == 2) {
                if(!this.name) {
                    alert('Tên không được để trống');
                    return false;
                }
            }
            if(this.step == 1 || this.step == 2) {
                let index = 0, accept = true;
                let app = this;
                let checkEquipments = this.equipments.every(e => {
                    let check = app.checkEquipment(e, index);
                    index++;
                    return check;
                });
                return checkEquipments;
            }
            return true;
        },
        checkEquipment(equipment, index) {
            if(!equipment.name) {
                alert('Bạn chưa nhập tên cho thiết bị thứ ' + (index + 1));
                return false;
            }
            if(!equipment.supplier_name) {
                alert('Bạn chưa nhập nhà cung cấp cho thiết bị thứ ' + (index + 1));
                return false;
            }
            if(!equipment.price) {
                alert('Bạn chưa nhập giá cho thiết bị thứ ' + (index + 1));
                return false;
            }
            return true;
        },
        addEquipmentInput() {
            let equipmentInput = {
                name: '',
                input_date: '',
                price: '',
                supplier_id: '',
                supplier_name: '',
                warranty: '',
                note: '',
                condition: 2,
                status: 1
            };
            this.equipments.push(equipmentInput);
        },
        removeEquipmentInput(index) {
            this.equipments.splice(index, 1);
        },
        submitTemplate() {
            this.sendEvent();
        },
        changeSupplier(result, equipment){
            equipment.supplier_name = result.value.name;
            if(result.found) {
                equipment.supplier_id = result.value.id;
            } else {
                equipment.supplier_id = null;
            }
            this.store();
        },
        getCategoryName(id) {
            let cate = this.categories.find(x => x.id == id);
            return cate.name;
        },
        handleFileUpload() {
            // this.imageFile = this.$refs.imageFile.files[0];
            Vue.set(this.$data, 'imageFile', this.$refs.imageFile.files[0]);
        },
        sendEvent() {
            let data = {
                name: this.name,
                category_id: this.category,
                imageFile: this.imageFile,
                equipments: this.equipments
            };
            this.$emit('change', data);
        },
        displayInput() {
            return this.step == 1;
        },
        displayText() {
            return this.step == 2;
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
    },
}
</script>
<style scoped>
#msform fieldset {
    width: 100%;
    margin: auto;
}
.date-picker {
    width: 160px;
}
</style>