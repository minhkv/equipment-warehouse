@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="/css/card.css">
<div id="equipment" class="container">

    <div class="row">
        <div class="col-md-12 text-center">
            <h2>Danh sách thiết bị</h2>
        </div>
    </div>

    <div class="row mb-4">
        <div class="dropdown col-2">
            <select class="custom-select mx-4 shadow" v-model="category_id">
                <option selected value='-1'>Loại thiết bị</option>
                <option selected value='0'>Tất cả</option>
                @foreach($categories as $category)
                <option value="{{$category->id}}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-6 offset-1">
            <form class="my-2 my-lg-0 px-2">
                <div class="input-group">
                    <input v-model="search" class="form-control mr-sm-2" type="search" placeholder="Tìm kiếm" aria-label="search" aria-describedby="basic-addon2">
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="submit"><span class="fa fa-search"></span></button>
                </div>
            </form>
        </div>
        <a href="{{ route('equipment-template.create') }}" class="btn btn-success ml-auto shadow">Thêm thiết bị</a>
    </div>
    <!-- Paginator -->
    <div class="row justify-content-center">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><button class="page-link active" href="#" :disabled="page <= 1" @click="page--">Previous</button></li>
                <li class="page-item" v-for="pageNumber in pages.slice(page-1, page+5)"><a class="page-link" href="#"  @click="page = pageNumber">@{{pageNumber}}</a></li>
                <li class="page-item"><button class="page-link" href="#" @click="page++" :disabled="page >= pages.length" class="page-link">Next</button></li>
            </ul>
        </nav>
    </div>
    <div class="row justify-content-center py-4">
        <div v-for="(template, index) in displayedTemplates" class="col-md-3 my-2">
            <div class="card fast-transition">
                <a :href="equipmentTemplateShowUrl(template.id)">
                    <img :src="template.image" class="card-img-top" :alt="template.name">
                </a>
                <div class="card-body d-flex flex-column">
                    <div class="card-block mt-auto my-1">
                        <h5 class="card-title">@{{ template.name }}</h5>
                        <p class="card-text">Số lượng: @{{ template.equipments.length }}</p>
                    </div>
                    <div>
                        <a href="#" class="btn btn-warning"><span class="fa fa-plus"></span> Thêm vào giỏ</a>
                        <a :href="equipmentTemplateShowUrl" class="btn btn-primary"><span class="fa fa-pencil"></span></a>
                        <button class="btn btn-danger" @click="equipmentDestroy(template.id, index)">
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
                <li class="page-item"><button class="page-link active" href="#" :disabled="page <= 1" @click="page--">Previous</button></li>
                <li class="page-item" v-for="pageNumber in pages.slice(page-1, page+5)"><a class="page-link" href="#"  @click="page = pageNumber">@{{pageNumber}}</a></li>
                <li class="page-item"><button class="page-link" href="#" @click="page++" :disabled="page >= pages.length" class="page-link">Next</button></li>
            </ul>
        </nav>
    </div>

</div>
<script>
    var app = new Vue({
        el: '#equipment',
        data: {
            equipmentTemplates: {},
            search: '',
            category_id: 0,
            page: 1,
            perPage: 12,
            pages: [],
        },
        created: function() {
            console.log('created');
            this.equipmentTemplates = <?php echo json_encode($equipmentTemplates); ?>;
        },
        methods: {
            equipmentTemplateShowUrl: function(id) {
                return '<?php echo route("equipment-template.index");?>' + '/' + id;
            },
            equipmentTemplateDeleteUrl: function(id) {
                return '<?php echo route("equipment-template.index");?>' + '/' + id;
            },
            equipmentDestroy: function(id, index) {
                if(confirm('Bạn có chắc chắn muốn xóa?')){
                    axios.delete(this.equipmentTemplateDeleteUrl(id))
                    .then(res => {
                        console.log(res);
                    }).catch(function(error) {
                        console.log(error);
                    });
                    this.equipmentTemplates.splice(index, 1);
                }
            },
            equipmentTemplateCategory: function(category_id, equipmentTemplateList) {
                if(category_id <= 0) return equipmentTemplateList;
                var result = equipmentTemplateList.filter(function(template) {
                    return template.category_id == category_id;
                });
                return result;
            },
            equipmentTemplateSearch: function (equipmentTemplateList) {
                var search = this.search.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
                var result = equipmentTemplateList.filter(function(template) {
                    var name = template.name.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
                    return (name.includes(search));
                });
                return result;
            },
            equipmentTemplateFilter: function (category_id, equipmentTemplateList) {
                var result = this.equipmentTemplateCategory(category_id, equipmentTemplateList);
                result = this.equipmentTemplateSearch(result);
                return result;
            },

            setPages() {
                var itemPerPage = this.perPage;
                let numberOfPages = Math.ceil(this.equipmentTemplateFilter(this.category_id, this.equipmentTemplates).length / itemPerPage);
                this.pages = [];
                for (let index = 1; index <= numberOfPages; index++) {
                    this.pages.push(index);
                }
            },
            paginate(itemList) {
                let page = this.page;
                itemPerPage = this.perPage;
                let from = (page * itemPerPage) - itemPerPage;
                let to = (page * itemPerPage);
                return itemList.slice(from, to);
            }
        },
        computed: {
            displayedTemplates() {
                let templates = this.equipmentTemplateFilter(this.category_id, this.equipmentTemplates);
                return this.paginate(templates);
            }
        },
        watch: {
            equipmentTemplates() {
                this.setPages();
            },
            category_id() {
                this.setPages();
            },
            search() {
                this.setPages();
            }
        },
    });
</script>

@endsection