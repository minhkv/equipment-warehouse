<template>
    <div>
        <div class="form-group">
            <label for="price">Tên thiết bị</label>
            <input type="text" class="form-control" v-model="eq.name" placeholder="Tên thiết bị">
        </div>
        <div class="form-group">
            <label for="price"><i class="fa fa-calendar"></i> Ngày nhập</label>
            <input type="datetime-local" class="form-control" v-model="eq.input_date" placeholder="Giá nhập">
        </div>
        <div class="form-group">
            <label for="price"><i class="fa fa-money"></i> Giá nhập</label>
            <input type="text" class="form-control" name="price" v-model="eq.price" placeholder="Giá nhập">
        </div>
        <div class="form-group">
            <label for="price"><i class="fa fa-building"></i> Nhà cung cấp</label>
            <autocomplete-input @change="changeSupplier($event)" :items="suppliers" name-attribute="name" placeholder="Nhà cung cấp" :value="eq.supplier_name"></autocomplete-input>
        </div>

        <div class="form-group">
            <label for="price"><i class="fa fa-signal"></i> Tình trạng</label>
            <div class="dropdown">
                <select v-model="eq.condition" class="custom-select mx-0">
                    <option value='2'><equipment-condition :condition="2"></equipment-condition></option>
                    <option selected value='1'><equipment-condition :condition="1"></equipment-condition></option>
                    <option value='0'><equipment-condition :condition="0"></equipment-condition></option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="price"><i class="fa fa-clipboard"></i> Ghi chú</label>
            <textarea class="form-control" name="note"  placeholder="Ghi chú" v-model="eq.note" ></textarea>
        </div>

        <button @click="sendRequest()" type="button" class="btn btn-primary mb-2">Xong</button>
    </div>
</template>
<script>
import moment from 'moment';
export default {
    props: [
        'equipment', 
        'template',
        'suppliers',
        'method',
        'url'
        ],
    data() {
        return {
            eq: {},
            event: '',
            blankEq: {
                input_date: moment().format("YYYY-MM-DDTHH:MM:SS"),
                price: '',
                supplier_id: '',
                supplier_name: '',
                condition: 2,
                status: 1,
                note: '',
            }
        };
    },
    created() {
        this.eq = Object.assign({}, this.eq, this.blankEq);
        if (this.equipment) {
            this.eq = Object.assign({}, this.eq, this.equipment);
            this.eq.input_date = moment(this.eq.input_date).format("YYYY-MM-DDTHH:MM:SS");
        }

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
            if(!this.eq.input_date) {
                alert('Bạn chưa nhập ngày');
                return false;
            }
            if(!this.eq.price) {
                alert('Bạn chưa nhập giá');
                return false;
            }
            if(!this.eq.supplier_id && !this.eq.supplier_name) {
                alert('Bạn chưa nhập nhà cung cấp');
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
        },
        changeSupplier(result){
            this.eq.supplier_name = result.value.name;
            if(result.found) {
                this.eq.supplier_id = result.value.id;
            } else {
                this.eq.supplier_id = null;
            }
        }
    }
};
</script>
<style scoped>
</style>