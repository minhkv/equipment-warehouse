<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-10 m-auto">
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
                                    <input v-model="guestName" type="text" class="form-control" placeholder="Nhà cung cấp">
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
                                <label class="col-9 text-left">{{guestName}}</label>
                            </div>
                            <div class="row">
                                <label class="col-3 text-left">Ngày nhập</label>
                                <label class="col-9 text-left">{{ dateInput }}</label>
                            </div>
                        </div>

                        <div v-if="step > 0">
                            <table class="table mt-2 templateTable">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center" scope="col" width="10%"></th>
                                        <th class="text-center" scope="col" width="25%">Tên thiết bị</th>
                                        <th class="text-center" scope="col" width="11%">Số lượng</th>
                                        <th class="text-center" scope="col" width="15%">Giá nhập</th>
                                        <th class="text-center" scope="col" width="15%">Bảo hành</th>
                                        <th class="text-center" scope="col" width="10%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th class="text-center" scope="row"></th>
                                        <td class="align-middle text-center">Máy ảnh canon m50</td>
                                        <td class="align-middle text-center">10</td>
                                        <td class="align-middle text-center">15,000,000đ</td>
                                        <td class="align-middle text-center">20/09/2020</td>
                                        <td class="align-middle text-center"></td>
                                    </tr>
                                    <tr v-show="false">
                                        <td colspan="5">Chưa có thiết bị nào. Hãy chọn thiết bị cần mượn.</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row justify-content-center">
                                <!-- Paginator -->
                                <!-- <pagination @change="paginationSelected" :items="selectedTemplates" per="6"></pagination> -->
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
            <div class="row">
                <div class="dropdown col-3">
                    <!-- Select -->
                    <selection-filter
                        :items="templates"
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
                        <th class="text-center" scope="col" width="25%">Tên thiết bị</th>
                        <th class="text-center" scope="col" width="11%">Số lượng</th>
                        <th class="text-center" scope="col" width="15%">Giá nhập</th>
                        <th class="text-center" scope="col" width="15%">Bảo hành</th>
                        <th class="text-center" scope="col" width="10%"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="template in paginateItems" :key="template.id">
                        <th class="text-center" scope="row"><img :src="template.image" height=40 :alt="template.name"></th>
                        <td class="align-middle text-center">{{ template.name }}</td>
                        <td class="align-middle text-center">
                            <input type="number" class="form-control">
                        </td>
                        <td class="align-middle text-center">
                            <input type="number" class="form-control">
                        </td>
                        <td class="align-middle text-center">
                            <input type="datetime-local" class="form-control">
                        </td>
                        <td class="align-middle text-center">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox"> 
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
            <template v-slot:footer>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Xong</button>
            </template>
        </modal-component>
        <modal-component id="createEquipment" title="Tạo mẫu mới">
            <equipment-template-form :categories="categories"></equipment-template-form>
        </modal-component>
    </div>
</template>
<script>
export default {
    props: ["templates", 'categories'],
    data() {
        return {
            step: 0,
            guestName: '',
            dateInput: '',
            submit: false,
            filterConfig: {
                values: [],
                all: { name: "Loại thiết bị", value: 0 },
                by: "category_id",
            },
            filterItems: [],
            searchItems: [],
            paginateItems: [],
            paginateSelectedItems: [],
            displayedTemplates: [],
        };
    },
    created() {
        this.init();
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
        validate() {
            return true;
        },
        nextStep: function() {
            if(!this.validate()) return;
            if(this.step < 2)
                this.step ++;
        },
        previousStep: function() {
            if(this.step > 0) {
                this.step --;
            }
        },
    }
}
</script>
<style scoped>
#msform fieldset {
    width: 90%;
    margin: auto;
}
</style>