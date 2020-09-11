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
        'template',
        'method',
        'url'
        ],
    data() {
        return {
            eq: {},
            event: '',
            blankEq: {
                size: '',
                price: '',
                supplier_id: '',
                location: '',
                condition: 5,
                status: 1,
                note: '',
            }
        };
    },
    created() {
        Object.assign(this.eq, this.blankEq);
        if (this.equipment) {
            // this.eq.size = this.equipment.size;
            // this.eq.price = this.equipment.price;
            // this.eq.supplier_id = this.equipment.supplier_id;
            // this.eq.location = this.equipment.location;
            // this.eq.condition = this.equipment.condition;
            // this.eq.note = this.equipment.note;
            Object.assign(this.eq, this.equipment);
        }

        // this.eq = this.equipment || this.blankEq;
        if(this.template) {
            this.eq['template_id'] = this.template.id;
        }
        if(this.method == "POST") {
            this.event = 'store';
        }
        if(this.method == "PUT") {
            this.event = 'update';
        }
    },
    methods: {
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
            let formData = {}, newEq = {};
            let app = this;
            for(const att in this.eq) {
                formData[att] = this.eq[att];
            }
            axios({
                method: this.method,
                url: this.url, 
                data: formData
                })
                .then(function (res) {
                    console.log(res);
                    app.eq = res.data;
                    app.sendEvent();
                })
                .catch(function (err) {
                    console.log(err);
                });
        },
        sendEvent() {
            console.log('sendEvent');
            this.$emit(this.event, this.eq);
            this.$emit('close');
        }
    }
};
</script>
<style scoped>
</style>