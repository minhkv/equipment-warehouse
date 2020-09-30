<template>
    <div>
        <div class="text-center"><h2 class="fs-title">Thêm mẫu mới</h2></div>
                
        <div class="form-group">
            <label>Tên thiết bị</label>
            <input v-model="name" type="text" class="form-control" placeholder="Tên thiết bị">
        </div>
        <div class="form-group">
            <label for="equipmentCategory">Loại thiết bị</label>
            <selector v-model="category" :items="displayedCategories" labelAtt="name" valueAtt="id"></selector>
        </div>
        <div class="form-group">
            <label for="equipmentImage">Hình ảnh thiết bị</label>
            <input v-on:change="handleFileUpload()" ref="imageFile" type="file"  class="form-control-file">
        </div>
        <button @click="submitTemplate()" type="button" class="btn btn-primary mb-2">Tạo thiết bị</button>
    </div>
</template>
<script>
export default {
    props: ['categories'],
    data() {
        return {
            name: '',
            category: 1,
            imageFile: {},
            displayedCategories: []
        };
    },
    created() {
        this.init();
    },
    methods: {
        init() {
            this.displayedCategories = this.categories;
        },
        submitTemplate() {

        },
        handleFileUpload() {

        },
        sendEvent() {
            let data = {
                name: this.name,
                category_id: this.categories,
                imageFile: this.imageFile
            };
            this.$emit('change', data);
        }
    },
}
</script>
<style scoped>

</style>