<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 mx-auto">
                <table class="table table-bordered mt-2">
                    <thead class="thead-light">
                        <tr>
                            <th class="align-middle text-center" scope="col" width="5%">ID</th>
                            <th class="align-middle text-center" scope="col" width="15%">Name</th>
                            <th class="align-middle text-center" scope="col" width="20%">Email</th>
                            <th class="align-middle text-center" scope="col" width="20%">Roles</th>
                            <th class="align-middle text-center" scope="col" width="15%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(user) in paginateItems" :key="user.id">
                            <th class=" align-middle text-center" scope="row">{{user.id}}</th>
                            <td class=" align-middle text-center" scope="row">{{user.name}}</td>
                            <td class="align-middle text-center">{{ user.email }}</td>
                            <td class="align-middle text-center">{{ displayRoles(user) }}</td>
                            <td class="align-middle text-center">
                                <button class="btn btn-primary" data-toggle="modal" :data-target="'#editUser' + user.id">Edit</button>
                                <button @click="deleteUser(user)" class="btn btn-danger">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row justify-content-center">
            <pagination @change="pagination($event)" :items="displayedUsers" per='10'></pagination>
        </div>
        <modal-component v-for="user in displayedUsers" :key="user.id" :id="'editUser' + user.id" :title="'Edit user' + user.id">
            <user-form @change="updateUser($event, user)" :user="user" :roles="roles" :url="userIndexUrl + '/' + user.id" method="put"></user-form>
        </modal-component>
    </div>
</template>

<script>
import ModalMixin from '../../mixins/ModalMixin';
import RequestMixin from '../../mixins/RequestMixin';
export default {
    mixins: [ModalMixin, RequestMixin],
    props: ['users', 'roles', 'userIndexUrl'],
    data() {
        return {
            displayedUsers: [],
            paginateItems: []
        };
    },
    created() {
        this.init();
    },
    methods: {
        init() {
            if(this.users) {
                this.displayedUsers = this.users;
            }
        },
        displayRoles(user) {
            let roles = user.roles.map(role => {
                return role.name;
            });
            return roles.join(',');
        },
        updateUser(data, user) {
            console.log('listen');
            user.roles = data.roles;
            this.closeModal("#editUser" + user.id);
        },
        deleteUser(user) {
            let url = this.userIndexUrl + '/' + user.id;
            let app = this;
            this.sendRequest(url, 'delete', {}, function() {
                let index = app.displayedUsers.findIndex(x => x.id == user.id);
                app.displayedUsers.splice(index, 1);
            });
        },
        pagination(items) {
            this.paginateItems = items;
        },
    }
}
</script>

<style scoped>

</style>