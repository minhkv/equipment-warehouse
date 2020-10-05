<template>
    <div class="container">
        <div class="row py-3">
            <div class="col-md-12 text-center">
                <h2>Danh sách kênh</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th class="align-middle text-center" scope="col">Mã</th>
                            <th class="align-middle text-center" scope="col">Tên</th>
                            <th class="align-middle text-center" scope="col" style="width:  18.33%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in displayedItems" :key="item.id">
                            <th class="align-middle text-center" scope="row">{{ item.id }}</th>
                            <td class="align-middle text-center">{{ item.name}}</td>
                            <td class="align-middle text-center">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" :data-target="'#edit' + item.id">
                                    <span class="fa fa-edit"></span>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <modal-component v-for="item in displayedItems" :key="item.id" :id="'edit' + item.id" :title="'Chỉnh sửa phòng ban ' + item.id">
            <department-form></department-form>
        </modal-component>
    </div>
</template>

<script>
export default {
    props: ['departments'],
    data() {
        return {
            displayedItems: []
        };
    },
    created() {
        this.init();
    },
    methods: {
        init() {
            if(this.departments)
                this.displayedItems = this.departments;
        }
    }
}
</script>

<style scoped>

</style>