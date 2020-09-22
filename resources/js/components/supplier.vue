<template>
    <div class="container">
        <div class="row py-3">
            <div class="col-md-12 text-center">
                <h2>Danh sách nhà cung cấp</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Mã</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Ghi chú</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="supplier in displayedSuppliers" :key="supplier.id">
                        <th class="align-middle" scope="row">{{ supplier.id }}</th>
                        <td class="align-middle">{{ supplier.name}}</td>
                        <td class="align-middle">{{ supplier.address }}</td>
                        <td class="align-middle">{{ supplier.phone_number }}</td>
                        <td class="align-middle">{{ supplier.note }}</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" :data-target="'#editSupplier' + supplier.id">
                                <span class="fa fa-pencil"></span>
                            </button>
                            <button @click="removeSupplier(supplier)" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
         <div class="row justify-content-center">
            <!-- Add supplier -->
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addSupplier">
                <span class="fa fa-plus"></span>
            </button>
        </div>
        <modal-component v-for="(supplier, index) in displayedSuppliers" :key="supplier.id" :id="'editSupplier' + supplier.id" title="Chỉnh sửa nhà cung cấp" size="">
            <supplier-form @change="updateSupplier($event, index, supplier.id)" :supplier="supplier" method="PUT" :url="updateSupplierUrl(supplier)"></supplier-form>
        </modal-component>
        <modal-component id="addSupplier" title="Thêm nhà cung cấp" size="">
            <supplier-form @change="addSupplier($event)" method="POST" :url="storeSupplierUrl"></supplier-form>
        </modal-component>
    </div>
</template>
<script>
export default {
    props: ['suppliers', 'supplierIndexUrl', 'storeSupplierUrl'],
    data() {
        return {
            displayedSuppliers: []
        };
    },
    created() {
        this.init();
    },
    methods: {
        init() {
            this.suppliers.forEach(supplier => {
                let s;
                s = Object.assign({}, s, supplier);
                this.displayedSuppliers.push(s);
            });
        },
        updateSupplierUrl(supplier) {
            return this.supplierIndexUrl + '/' + supplier.id;
        },
        deleteSupplierUrl(supplier) {
            return this.supplierIndexUrl + '/' + supplier.id;
        },
        addSupplier(newSupplier) {
            console.log('add');
            this.displayedSuppliers.push(newSupplier);
            this.closeModal('#addSupplier');
        },
        updateSupplier(newSupplier, id, supplier_id) {
            Vue.set(this.displayedSuppliers, id, newSupplier);
            this.closeModal('#editSupplier' + supplier_id);
        },
        removeSupplier(supplier) {
            console.log('delete');
            let app=this;
            let index = this.displayedSuppliers.findIndex(s => {
                return s.id == supplier.id;
            });
            if(index == -1) return;
            let url = this.supplierIndexUrl + '/' + supplier.id;
            axios({
                method: 'delete',
                url: url, 
                })
            .then(res => {
                console.log(res);
                app.displayedSuppliers.splice(index, 1);
            }).catch(err => {
                console.log(err);
            });
        },
        closeModal(id) {
            console.log('closeModal ' + id);
            $(id).modal('toggle');
            $(".modal-backdrop").remove();
        }
    },
}
</script>
<style scoped>

</style>