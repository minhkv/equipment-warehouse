<template>
    <div>
        <div class="form-group">
            <label for="equipmentName"><i class="fa fa-cogs"></i> Kích thước</label>
            <input type="text" class="form-control" name="size" v-model="eq.size" placeholder="Kích thước">
        </div>
        <div class="form-group">
            <label for="price"><i class="fa fa-money"></i> Giá nhập</label>
            <input type="text" class="form-control" name="price" v-model="eq.price" placeholder="Giá nhập">
        </div>
        <div class="form-group">
            <label for="price"><i class="fa fa-building"></i> Nhà cung cấp</label>
            <input type="text" class="form-control" name="supplier_id" v-model="eq.supplier_id" placeholder="Nhà cung cấp">
        </div>
        <div class="form-group">
            <label for="price"><i class="fa fa-location-arrow"></i> Vị trí</label>
            <input type="text" class="form-control" name="location" v-model="eq.location" placeholder="Vị Trí">
        </div>
        <div class="form-group">
            <label for="price"><i class="fa fa-signal"></i> Tình trạng</label>
            <!-- <x-star-input name="condition" id="edit-{{$eId}}" v-model="eq.condition" /> -->
        </div>
        <div class="form-group">
            <label for="price"><i class="fa fa-clipboard"></i> Ghi chú</label>
            <textarea class="form-control" name="note"  placeholder="Ghi chú" v-model="eq.note" ></textarea>
        </div>

        <button @click="sendRequest()" type="button" class="btn btn-primary mb-2">Xong</button>
    </div>
</template>
<script>
export default {
    props: [
        'equipment', 
        'method',
        'url'
        ],
    data() {
        return {
            eq: {}
        };
    },
    created() {
        this.eq.size = this.equipment.size || '';
        this.eq.price = this.equipment.price || '';
        this.eq.supplier_id = this.equipment.supplier_id || '';
        this.eq.location = this.equipment.location || '';
        this.eq.condition = this.equipment.condition || '';
        this.eq.note = this.equipment.note || '';
    },
    methods: {
        displayEquipmentStatusClass(status) {
            return {
                'badge': true, 
                'badge-pill':true, 
                'badge-danger': status == 0,
                'badge-success': status == 1,
                'badge-primary': status == 2
            };
        },
        validateData() {
            if(!this.eq.size) {
                alert('Bạn chưa nhập kích thước');
                return false;
            }
            if(!this.eq.price) {
                alert('Bạn chưa nhập giá');
                return false;
            }
            if(!this.eq.supplier_id) {
                alert('Bạn chưa nhập nhà cung cấp');
                return false;
            }
            if(!this.eq.location) {
                alert('Bạn chưa nhập vị trí');
                return false;
            }
            if(!this.eq.condition) {
                alert('Bạn chưa nhập tình trạng');
                return false;
            }
            return true;
        },
        sendRequest() {
            console.log('sendRequest');
            if(!this.validateData()) return;
            let formData = {};
            for(const att in this.eq) {
                formData[att] = this.eq[att];
            }
            console.log(formData);
            axios({
                method: this.method,
                url: this.url, 
                data: formData
                })
                .then(function (res) {
                    console.log(res);
                })
                .catch(function (err) {
                    console.log(err);
                });
        }
    }
};
</script>
<style scoped>
</style>