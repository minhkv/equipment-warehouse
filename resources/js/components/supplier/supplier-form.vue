<template>
    <div>
        <div class="form-group">
            <label><i class="fa fa-user"></i> Tên</label>
            <input type="text" class="form-control" name="name" v-model="item.name" placeholder="Tên nhà cung cấp">
        </div>
        <div class="form-group">
            <label><i class="fa fa-address-card"></i> Địa chỉ</label>
            <input type="text" class="form-control" name="address" v-model="item.address" placeholder="Địa chỉ">
        </div>
        <div class="form-group">
            <label for="price"><i class="fa fa-phone"></i> Số điện thoại</label>
            <input type="text" class="form-control" name="phone_number" v-model="item.phone_number" placeholder="Số điện thoại">
        </div>
        <div class="form-group">
            <label><i class="fa fa-clipboard"></i> Ghi chú</label>
            <textarea v-model="item.note" class="form-control" name="note" placeholder="Ghi chú" ></textarea>
        </div>
        <button @click="sendRequest()" type="button" class="btn btn-primary mb-2">Xong</button>
    </div>
</template>
<script>
export default {
    props: ['supplier', 'method', 'url'],
    data() {
        return {
            item: {}
        };
    },
    created() {
        this.init();
    },
    methods: {
        init() {
            if (this.supplier) {
                this.item = Object.assign({}, this.item, this.supplier);
            }
        },
        validateData() {
            if(!this.item.name) {
                alert('Bạn chưa nhập tên');
                return false;
            }
            return true;
        },
        sendRequest() {
            if(!this.validateData()) return;
            console.log('sendRequest');
            let formData = {}, newEq = {};
            let app = this;
            formData = Object.assign({}, formData, this.item);
            axios({
                method: this.method,
                url: this.url, 
                data: formData
                })
                .then(function (res) {
                    console.log(res);
                    app.item = res.data;
                    app.sendEvent();
                })
                .catch(function (err) {
                    console.log(err);
                });
        },
        sendEvent() {
            this.$emit('change', this.item);
        }
    }

}
</script>
<style scoped>

</style>