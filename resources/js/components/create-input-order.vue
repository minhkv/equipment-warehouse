<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 m-auto">
                <form id="msform">
                    <div class="track">
                        <div :class="{'step': true, 'active': step >= 0}">
                            <span class="icon"> <i class="fa fa-info"></i> </span>
                            <span class="text">Thông tin đơn nhập</span>
                        </div>
                        <div :class="{'step': true, 'active': step >= 1}">
                            <span class="icon"> <i class="fa fa-desktop"></i> </span>
                            <span class="text">Chọn thiết bị</span>
                        </div>
                        <div :class="{'step': true, 'active': step >= 2}">
                            <span class="icon"> <i class="fa fa-check"></i> </span>
                            <span class="text"> Xác nhận</span>
                        </div>
                    </div>
                    <fieldset>
                        <div v-show="step==0">
                            <h2 class="fs-title">Thông tin đơn nhập</h2>
                            <div class="form-group row">
                                <label class="col-3 col-form-label text-left">Nhà cung cấp</label>
                                <div class="col-9">
                                    <!-- <input v-model="guestName" type="text" class="form-control" placeholder="Nhà cung cấp"> -->
                                    <autocomplete-input @change="changeSupplier($event)" :items="suppliers" name-attribute="name" placeholder="Nhà cung cấp" :value="supplier_name"></autocomplete-input>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="dateInput" class="col-3 col-form-label text-left">Ngày nhập</label>
                                <div class="col-9">
                                    <input v-model="dateInput" class="form-control" type="datetime-local" id="dateBorrowed">
                                </div>
                            </div>
                        </div>
                        <div v-show="step==1">
                            <h2 class="fs-title">Chọn thiết bị</h2>
                        </div>
                        <div v-show="step==2">
                            <h2 class="fs-title">Xác nhận</h2>
                            <div class="row">
                                <label class="col-3 text-left">Nhà cung cấp</label>
                                <label class="col-9 text-left">{{supplier_name}}</label>
                            </div>
                            <div class="row">
                                <label class="col-3 text-left">Ngày nhập</label>
                                <label class="col-9 text-left">{{ dateInput | formatDate }}</label>
                            </div>
                        </div>

                        <div v-if="step > 0">
                            <table class="table mt-2 templateTable">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center" scope="col" width="10%">Mã</th>
                                        <th class="text-center" scope="col" width="10%"></th>
                                        <th class="text-center" scope="col" width="25%">Tên thiết bị</th>
                                        <th class="text-center" scope="col" width="11%">Số lượng</th>
                                        <th class="text-center" scope="col" width="15%">Giá nhập</th>
                                        <th class="text-center" scope="col" width="20%">Bảo hành</th>
                                        <th class="text-center" scope="col" width="10%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in paginateItems" :key="item.template.id">
                                        <th class="align-middle text-center" scope="row">{{item.template.id}}</th>
                                        <th class="align-middle text-center" scope="row">
                                            <img :src="item.template.image" height=40 :alt="item.template.name">
                                        </th>
                                        <td class="align-middle text-center">
                                            {{item.template.name}}
                                        </td>
                                        <td class="align-middle text-center">
                                            <input v-if="displayInput()" type="number" class="form-control" v-model="item.amount">
                                            <div v-if="displayText()">{{item.amount}}</div>
                                        </td>
                                        <td class="align-middle text-center">
                                            <input v-if="displayInput()" type="number" class="form-control" v-model="item.price">
                                            <div v-if="displayText()">{{item.price}}</div>
                                        </td>
                                        <td class="align-middle text-center">
                                            <input v-if="displayInput()" type="datetime-local" class="form-control" v-model="item.warranty">
                                            <div v-if="displayText()">{{item.warranty | formatDate}}</div>
                                        </td>
                                        <td class="align-middle text-center">
                                            <button @click="removeItem(item)" v-if="displayInput()" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr v-show="false">
                                        <td colspan="5">Chưa có thiết bị nào. Hãy chọn thiết bị cần mượn.</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row justify-content-center">
                                <!-- Paginator -->
                                <pagination @change="pagination($event)" :items="displayedItems" per="6"></pagination>
                            </div>
                            <div v-if="step==1">
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
                        </div>

                        <button v-show="step > 0" type="button" class="btn btn-secondary next action-button" @click="previousStep()">Quay lại</button>
                        <button v-show="step < 2" type="button" class="btn btn-primary previous action-button" @click="nextStep()">Tiếp tục</button>
                        <button v-show="step == 2" type="button" class="btn btn-success previous action-button" :disabled="submit">Hoàn tất</button>
                    </fieldset>
                </form>
            </div>
        </div>
        <modal-component id="addEquipment" title="Thêm thiết bị" size="xl">
            <table-input-template @change="updateSelectedTemplates($event)" :templates="templates" :categories="categories"></table-input-template>
            <template v-slot:footer>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Xong</button>
            </template>
        </modal-component>
        <modal-component id="createEquipment" title="Tạo mẫu mới">
            <equipment-template-form @change="createTemplate()" :categories="categories"></equipment-template-form>
        </modal-component>
    </div>
</template>
<script>
export default {
    props: ['suppliers', 'templates', 'categories'],
    data() {
        return {
            step: 0,
            supplier_name: '',
            supplier_id: '',
            dateInput: '',
            submit: false,
            displayedItems: [],
            paginateItems: [],
            itemNeedToRemove: {}
        };
    },
    created() {
        this.init();
    },
    methods: {
        init() {

        },
        validate() {
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
        createTemplate() {
            console.log('createTemplate');
        },
        updateSelectedTemplates(items) {
            this.displayedItems = items;
        },
        pagination(items) {
            this.paginateItems = items;
        },
        displayInput() {
            return this.step == 1;
        },
        displayText() {
            return this.step == 2;
        },
        changeSupplier(result){
            this.supplier_name = result.value.name;
            if(result.found) {
                this.supplier_id = result.value.id;
            } else {
                this.supplier_id = null;
            }
        },
        removeItem(item) {
            console.log('removeItem');
            this.itemNeedToRemove = item;
            let index = this.displayedItems.findIndex(i => i.template.id == item.template.id);
            this.displayedItems.splice(index, 1);
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