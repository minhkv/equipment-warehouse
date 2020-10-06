<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="text-center"><h2 class="fs-title">Thêm mẫu mới</h2></div>
                
                <div class="form-group">
                    <label>Tên thiết bị</label>
                    <input v-model="name" type="text" class="form-control" placeholder="Tên thiết bị">
                </div>
                <div class="form-group">
                    <label for="equipmentCategory">Loại thiết bị</label>
                    <div class="row">
                        <div class="col-10">
                            <selector v-model="category" :items="displayedCategories" labelAtt="name" valueAtt="id" value="1"></selector>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreateCategory">
                                <span class="fa fa-plus"></span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="equipmentImage">Hình ảnh thiết bị</label>
                    <input v-on:change="handleFileUpload()" ref="imageFile" type="file"  class="form-control-file">
                </div>
                <button @click="submitTemplate()" type="button" class="btn btn-primary mb-2">Tạo thiết bị</button>
            </div>
        </div>
        <modal-component id="modalCreateCategory" title="Thêm loại thiết bị">
            <div class="form-group">
                <label for="category">Loại thiết bị</label>
                <input v-model="newCategory" type="text" class="form-control" placeholder="Nhập loại thiết bị">
            </div>
            <button @click="submitCategory()" type="button" class="btn btn-success">Thêm</button>
        </modal-component>
    </div>

</template>
<script>
import RequestMixin from '../../mixins/RequestMixin';
export default {
    mixins: [RequestMixin],
    props: ['categories', 'categoryCreateUrl', 'equipmentTemplateIndexUrl', 'equipmentTemplateCreateUrl'],
    data() {
        return {
            file: "",
            displayedCategories: [],
            name: "",
            category: 1,
            imageFile: '',
            newCategory: ''
        };
    },
    created() {
        this.init();
    },
    methods: {
        init() {
            this.displayedCategories = this.categories;
        },
        handleFileUpload() {
            console.log("change");
            this.imageFile = this.$refs.imageFile.files[0];
        },
        submitTemplate() {
            let formData = new FormData();
            let headers = {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            };
            formData.append("name", this.name);
            formData.append("category_id", this.category);
            formData.append("imageFile", this.imageFile);
            this.sendRequest(this.equipmentTemplateCreateUrl,
                'post', formData, this.redirectUrl);
        },
        redirectUrl(data) {
            window.location.href= data;
        },
        submitCategory() {
            let data = {
                name: this.newCategory
            };
            this.sendRequest(this.categoryCreateUrl, 'post', data, this.updateCategories);
        },
        updateCategories(data) {
            console.log('update');
            this.displayedCategories.push(data);
            this.closeModal('#modalCreateCategory');
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
#msform {
    text-align: center;
    position: relative;
    margin-top: 30px;
}

#msform fieldset {
    background: white;
    border: 0 none;
    border-radius: 0px;
    box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
    padding: 20px 30px;
    box-sizing: border-box;
    width: 80%;
    margin: 0 10%;

    /*stacking fieldsets above each other*/
    position: relative;
}

/*Hide all except first fieldset*/
#msform fieldset:not(:first-of-type) {
    display: none;
}

/*buttons*/
#msform .action-button {
    font-size: 13px;
    font-weight: bold;
    width: 100px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px;
    border-radius: 25px;
}

.page {
    min-height: 500px;
}

#msform .action-button:hover, #msform .action-button:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px #007bff;
}

#msform .action-button-previous {
    width: 100px;
    border: 0 none;
    border-radius: 25px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px;
}

#msform .action-button-previous:hover, #msform .action-button-previous:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px #efefef;
}
/*headings*/
.fs-title {
    font-size: 18px;
    text-transform: uppercase;
    color: #2C3E50;
    margin-bottom: 10px;
    letter-spacing: 2px;
    font-weight: bold;
}

.fs-subtitle {
    font-weight: normal;
    font-size: 13px;
    color: #666;
    margin-bottom: 20px;
}

.templateTable, .templateTable input {
    font-size: small;
}


/* Not relevant to this form */
.dme_link {
    margin-top: 30px;
    text-align: center;
}
.dme_link a {
    background: #FFF;
    font-weight: bold;
    color: #ee0979;
    border: 0 none;
    border-radius: 25px;
    cursor: pointer;
    padding: 5px 25px;
    font-size: 12px;
}

.dme_link a:hover, .dme_link a:focus {
    background: #C5C5F1;
    text-decoration: none;
}
    
</style>