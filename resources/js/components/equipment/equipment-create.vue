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
            this.sendRequest(this.equipmentTemplateCreateUrl, 'post', data, this.redirect);
        }, 
        redirect(data) {
            console.log(data);
            let url = this.equipmentTemplateIndexUrl + '/' + data.id;
            // window.location.replace(url);
        }
    },
};
</script>
<style scoped>
    
</style>