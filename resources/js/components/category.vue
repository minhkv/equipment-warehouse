<template>
    <div class="container">
        <div class="row">
            <div class="row py-3">
                <div class="col-md-12 text-center">
                    <h2>Danh sách loại thiết bị</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Mã</th>
                                <th scope="col">Tên</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col" style="width:  18.33%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="category in paginateItems" :key="category.id">
                                <th class="align-middle" scope="row">{{ category.id }}</th>
                                <td class="align-middle">{{ category.name}}</td>
                                <td class="align-middle">{{ category.templates.length }}</td>
                                <td class="align-middle">
                                    <!-- Add equipment -->
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" :data-target="'#editCategory' + category.id">
                                        <span class="fa fa-edit"></span>
                                    </button>
                                    <button @click="deleteCategory(category)" type="button" class="btn btn-danger btn-sm" >
                                        <span class="fa fa-trash"></span>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row justify-content-center">
                    <pagination :items="displayedCategories" per="8" @change="changePagination($event)"></pagination>
                </div>
                <div class="row justify-content-center">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addCategory">
                        Thêm loại thiết bị
                    </button>
                 </div>
            </div>
        </div>
        <modal-component v-for="category in displayedCategories" :key="category.id" :id="'editCategory' + category.id" title="Chỉnh sửa loại thiết bị">
            <category-form @change="edit($event)" :category="category"></category-form>
        </modal-component>
        <modal-component id="addCategory" title="Thêm loại thiết bị">
            <category-form @change="create($event)"></category-form>
        </modal-component>
    </div>
</template>
<script>
import RequestMixin from '../mixins/RequestMixin';
export default {
    mixins: [RequestMixin],
    props: ['categories', 'categoryCreateUrl', 'categoryIndexUrl'],
    data() {
        return {
            file: "",
            displayedCategories: [],
            categoryNames: [],
            paginateItems: []
        };
    },
    created() {
        this.init();
    },
    methods: {
        init() {
            this.displayedCategories = this.categories;
        },
        changePagination(items) {
            this.paginateItems = items;
        },
        create(category) {
            let data = {name: category.name};
            this.sendRequest(this.categoryCreateUrl, 'post', data, this.pushCategory);
        },
        edit(category) {
            let data = {name: category.name};
            let url = this.categoryIndexUrl + '/' + category.id;
            this.sendRequest(url, 'put', data, this.updatePage);
        },
        deleteCategory(category) {
            let data = {};
            let url = this.categoryIndexUrl + '/' + category.id;
            this.sendRequest(url, 'delete', data, console.log);
            this.removeCategory(category);
        },
        pushCategory(category) {
            this.displayedCategories.push(category);
        },
        removeCategory(category) {
            let index = this.displayedCategories.findIndex(x => x.id == category.id);
            console.log(index);
            this.displayedCategories.splice(index, 1);
        },
        updatePage(category) {
            this.closeModal('#editCategory' + category.id);
        },
        closeModal(id) {
            console.log('closeModal ' + id);
            $(id).modal('toggle');
            $(".modal-backdrop").remove();
        }
    },
};
</script>
<style scoped>
</style>