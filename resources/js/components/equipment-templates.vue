<template>
    <div id="equipment" class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h2>Danh sách thiết bị</h2>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-sm-12 col-md-3 col-lg-2 dropdown">
                <!-- Select -->
                <selection-filter
                    :items="equipmentTemplates"
                    :values="filterConfig.values"
                    :all="filterConfig.all"
                    :by="filterConfig.by"
                    @change="selectionFilter($event)"
                ></selection-filter>
            </div>
            <div class="col-sm-12 col-md-5 offset-md-1">
                <!-- Search -->
                <search-input :items="filterItems" :by="['name']" @change="searchInput($event)"></search-input>
            </div>
            <div class="col-sm-12 col-md-3 col-lg-2 ml-auto">
                <a :href="equipmentTemplateCreateUrl" class="btn btn-success shadow">Thêm thiết bị</a>
            </div>
        </div>
        <!-- Paginator -->
        <div class="row justify-content-center">
            <pagination :items="searchItems" :perPage="12" @change="pagination($event)"></pagination>
        </div>
        <div class="row justify-content-center py-4">
            <div
                v-for="(template, index) in paginateItems"
                :key="template.id"
                class="col-sm-6 col-md-4 col-lg-3 my-2">
                <div class="card fast-transition">
                    <a :href="equipmentTemplateShowUrl(template.id)">
                        <img :src="template.image" class="card-img-top" :alt="template.name" />
                    </a>
                    <div class="card-body d-flex flex-column">
                        <div class="card-block mt-auto my-1">
                            <h5 class="card-title">{{ template.name }}</h5>
                            <p class="card-text">Số lượng: {{ template.equipments.length }}</p>
                        </div>
                        <div class="overlay">
                            <a
                                :href="equipmentTemplateShowUrl(template.id)"
                                class="btn btn-primary btn-sm">
                                <span class="fa fa-edit"></span>
                            </a>
                            <button
                                class="btn btn-danger btn-sm"
                                @click="equipmentDestroy(template.id, index)">
                                <span class="fa fa-trash"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <h5 v-if="paginateItems.length == 0">Không có thiết bị nào.</h5>
        </div>
        <!-- Paginator -->
    </div>
</template>
<script>
export default {
    props: [
        "equipmentTemplates",
        "categories",
        "equipmentTemplateIndexUrl",
        "equipmentTemplateCreateUrl",
    ],
    data() {
        return {
            filterConfig: {
                values: [],
                all: { name: "Loại thiết bị", value: 0 },
                by: "category_id",
            },
            filterItems: [],
            searchItems: [],
            paginateItems: [],
            displayedTemplates: [],
            search: "",
            category_id: 0,
            page: 1,
            perPage: 12,
            pages: [],
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
        equipmentTemplateShowUrl(id) {
            return this.equipmentTemplateIndexUrl + "/" + id;
        },
        equipmentTemplateDeleteUrl(id) {
            return this.equipmentTemplateIndexUrl + "/" + id;
        },
        equipmentDestroy(id, index) {
            if (confirm("Bạn có chắc chắn muốn xóa?")) {
                axios
                    .delete(this.equipmentTemplateDeleteUrl(id))
                    .then((res) => {
                        console.log(res);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                for (var i in this.equipmentTemplates) {
                    if (this.equipmentTemplates[i].id == id) {
                        console.log(i);
                        this.equipmentTemplates.splice(i, 1);
                        break;
                    }
                }
                this.filterTemplate();
            }
        },
    },
};
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
.overlay {
    position: absolute;
    top: 10px;
    right: 10px;
}
</style>
