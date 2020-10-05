<template>
    <div>
        <div class="form-group">
            <label for="">Name</label>
            <input v-model="user.name" type="text" class="form-control" placeholder="Nhập tên" />
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input v-model="user.email" type="email" class="form-control" placeholder="Nhập email" />
        </div>
        <div v-for="role in roles" :key="role.id" class="form-check">
            <input v-model="userRoles" type="checkbox" class="form-check-input" :value="role.id">
            <label class="form-check-label">
                {{role.name}}
            </label>
        </div>
        <button @click="submit" class="btn btn-primary">Xong</button>
    </div>
</template>

<script>
import RequestMixin from '../../mixins/RequestMixin';
export default {
    mixins: [RequestMixin],
    props: ['user', 'roles', 'method', 'url'],
    data() {
        return {
            name: '',
            email: '',
            userRoles: []
        };
    },
    created() {
        this.init();
    },
    methods: {
        init() {
            this.set(this.user);
        },
        set(data) {
            if(data) {
                this.name = data.name;
                this.email = data.email;
                this.userRoles = data.roles.map(role => {
                    return role.id;
                });
            }
        },
        submit() {
            let app = this;
            let data = {
                name: this.name,
                email: this.email,
                roles: this.userRoles,
            };
            this.sendRequest(this.url, this.method, data, this.updatePage);
        },
        updatePage(data) {
            console.log(data);
            if(data.error) {
                alert(data.error);
                return;
            }
            this.set(data);
            this.sendEvent(data);
        },
        sendEvent(data) {
            this.$emit('change', data);
        }
    }
};
</script>

<style scoped>
</style>