<template>
    <div id="equipment" class="container">

        <div class="row">
            <div class="col-12 text-center">
                <h2>Danh sách thiết bị</h2>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-sm-12 col-md-3 col-lg-2 dropdown">
                <select class="custom-select shadow" v-model="category_id" v-on:change="filterTemplate">
                    <option value="0">Loại thiết bị</option>
                    <option v-for="cate in categories" :key="cate.id" :value="cate.id">{{ cate.name }}</option>
                </select>
            </div>
            <div class="col-sm-12 col-md-5 offset-md-1">
                <form class="my-2 my-lg-0">
                    <div class="input-group">
                        <input v-on:keyup="filterTemplate" v-model="search" class="form-control mr-sm-2" type="search" placeholder="Tìm kiếm">
                        <button class="btn btn-outline-primary my-2 my-sm-0" type="submit"><span class="fa fa-search"></span></button>
                    </div>
                </form>
            </div>
            <div class="col-sm-12 col-md-3 col-lg-2 ml-auto">
                <a :href="equipmentTemplateCreateUrl" class="btn btn-success shadow">Thêm thiết bị</a>
            </div>
        </div>
        <!-- Paginator -->
        <div class="row justify-content-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item"><button class="page-link active" href="#" :disabled="page <= 1" @click="page--">Previous</button></li>
                    <li :class="pageItemClass(page, pageNumber)" v-for="pageNumber in pages.slice(page-1, page+5)" :key="pageNumber"><a class="page-link" href="#"  @click="page = pageNumber">{{pageNumber}}</a></li>
                    <li class="page-item"><button class="page-link" href="#" @click="page++" :disabled="page >= pages.length">Next</button></li>
                </ul>
            </nav>
        </div>
        <div class="row justify-content-center py-4">
            <div v-for="(template, index) in paginate(displayedTemplates)" :key="template.id" class="col-sm-6 col-md-4 col-lg-3 my-2">
                <div class="card fast-transition">
                    <a :href="equipmentTemplateShowUrl(template.id)">
                        <img :src="template.image" class="card-img-top" :alt="template.name">
                    </a>
                    <div class="card-body d-flex flex-column">
                        <div class="card-block mt-auto my-1">
                            <h5 class="card-title">{{ template.name }}</h5>
                            <p class="card-text">Số lượng: {{ template.equipments.length }}</p>
                        </div>
                        <div>
                            <a href="#" class="btn btn-warning btn-sm"><span class="fa fa-plus"></span> Thêm vào giỏ</a>
                            <a :href="equipmentTemplateShowUrl(template.id)" class="btn btn-primary btn-sm"><span class="fa fa-pencil"></span></a>
                            <button class="btn btn-danger btn-sm" @click="equipmentDestroy(template.id, index)">
                                <span class="fa fa-trash"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <h5 v-if="displayedTemplates.length == 0">Không có thiết bị nào.</h5>
        </div>
        <!-- Paginator -->
        <div class="row justify-content-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item"><button class="page-link" href="#" :disabled="page <= 1" @click="page--">Previous</button></li>
                    <li  v-for="pageNumber in pages.slice(page-1, page+5)" :key="pageNumber" :class="pageItemClass(page, pageNumber)"><a class="page-link" href="#"  @click="page = pageNumber" >{{pageNumber}}</a></li>
                    <li class="page-item"><button class="page-link" href="#" @click="page++" :disabled="page >= pages.length">Next</button></li>
                </ul>
            </nav>
        </div>
    </div>
</template>
<script>
export default {
    props: [
        'equipmentTemplates',
        'categories',
        'equipmentTemplateIndexUrl',
        'equipmentTemplateCreateUrl'
    ],
    data() {
        return {
            displayedTemplates:[],
            search: '',
            category_id: 0,
            page: 1,
            perPage: 12,
            pages: [],
        };
    },
    created() {
        this.filterTemplate();
    },
    methods: {
        filterTemplate() {
            this.selectedType();
            this.searchTemplate();
            this.setPages();
        },
        selectedType(){
            if(this.category_id == 0) {
                this.displayedTemplates = this.equipmentTemplates;
            } else {
                this.displayedTemplates = this.equipmentTemplates.filter(x => x.category_id == this.category_id);
            }
        },
        searchTemplate() {
            this.displayedTemplates = this.displayedTemplates.filter(x => {
                var name = this.normalizeSearchString(x.name);
                var search = this.normalizeSearchString(this.search);
                return name.includes(search);
            });
        },
        normalizeSearchString(str) {
            return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
        },
        setPages() {
            var itemPerPage = this.perPage;
            let numberOfPages = Math.ceil(this.displayedTemplates.length / itemPerPage);
            this.page = 1;
            this.pages = [];
            for (let index = 1; index <= numberOfPages; index++) {
                this.pages.push(index);
            }
        },
        paginate(itemList) {
            let page = this.page;
            let from = (page * this.perPage) - this.perPage;
            let to = (page * this.perPage);
            return itemList.slice(from, to);
        },
        equipmentTemplateShowUrl(id) {
            return this.equipmentTemplateIndexUrl + '/' + id;
        },
        equipmentTemplateDeleteUrl(id) {
            return this.equipmentTemplateIndexUrl + '/' + id;
        },
        equipmentDestroy(id, index) {
            if(confirm('Bạn có chắc chắn muốn xóa?')){
                axios.delete(this.equipmentTemplateDeleteUrl(id))
                .then(res => {
                    console.log(res);
                }).catch(function(error) {
                    console.log(error);
                });
                for(var i in this.equipmentTemplates) {
                    if(this.equipmentTemplates[i].id == id) {
                        console.log(i);
                        this.equipmentTemplates.splice(i, 1);
                        break;
                    }
                }
                this.filterTemplate();
            }
        },
        pageItemClass(page, pageNumber) {
            console.log(page == pageNumber);
            return {
                'page-item': true,
                'active': page == pageNumber
            };
        }
    }
}
</script>
<style scoped>
    .fast-transition {
        position: relative;
        box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.3);
        transition: all 0.3s ease-in-out;
    }

    .fast-transition::before {
        /* content: ' '; */
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        /* border-radius: 50px; */
        box-shadow: 0 10px 50px 0 rgba(0, 0, 0, 0.5);
        opacity: 0;
        transition: opacity 500ms;
    }

    .fast-transition:hover::before {
        opacity: 1;
    }
    .fast-transition:hover {
        transform: scale(1.05);
    }
    .card {
        min-height: 400px;
    }
    .card-title {
        font-size: 1rem;
    }
</style>
