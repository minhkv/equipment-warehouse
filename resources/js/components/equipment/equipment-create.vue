<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <equipment-template-form @change="submit($event)" :categories="categories" :suppliers="suppliers"></equipment-template-form>
            </div>
        </div>
    </div>
</template>
<script>
import RequestMixin from '../../mixins/RequestMixin';
export default {
    mixins: [RequestMixin],
    props: ['categories', 'suppliers', 'categoryCreateUrl', 'equipmentTemplateIndexUrl', 'equipmentTemplateCreateUrl'],
    data() {
        return {

        };
    },
    created() {
        this.init();
    },
    methods: {
        init() {
            
        },
        submit(data) {
            console.log(data);
            let formData = new FormData();
            formData.append('name', data.name);
            formData.append('category_id', data.category_id);
            formData.append('equipments', data.equipments);
            formData.append('imageFile', data.imageFile);
            this.sendRequest(this.equipmentTemplateCreateUrl, 'post', formData, this.redirect);
        }, 
        redirect(data) {
            console.log(data);
            if(data.error) {
                alert(data.error);
                return;
            }
            let url = this.equipmentTemplateIndexUrl + '/' + data.id;
            window.location.replace(url);
        }
    },
};
</script>
<style scoped>
    
</style>