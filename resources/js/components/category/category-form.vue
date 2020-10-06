<template>
    <div>
        <div class="form-group">
            <label><i class="fa fa-user"></i> Tên</label>
            <input type="text" class="form-control" name="name" v-model="item.name" placeholder="Tên loại thiết bị">
        </div>
        <button @click="edit()" type="button" class="btn btn-primary mb-2">Lưu thay đổi</button>
    </div>
</template>
<script>
export default {
    props: ['category'],
    data() {
        return {
            item: {name: ''}
        };
    },
    created() {
        this.init();
    },
    methods: {
        init() {
            if(this.category)
                this.item = this.category;
        },
        edit() {
            this.sendEvent();
        },
        sendEvent() {
            this.$emit('change', this.item);
        },
    }
}
</script>
<style scoped>

</style>