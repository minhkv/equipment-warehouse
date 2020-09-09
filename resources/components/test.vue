<template>
    <div class="container">
        abc
        <div class="large-12 medium-12 small-12 cell">
            <label>
                File
                <input type="file" id="file" name="file" ref="file" v-on:change="handleFileUpload()" />
            </label>
            <button v-on:click="submitFile()">Submit</button>
        </div>
    </div>
</template>
<script>
export default {
    props: [],
    data() {
        return {
            file: "",
        };
    },
    methods: {
        handleFileUpload() {
            console.log("change");
            this.file = this.$refs.file.files[0];
        },
        submitFile() {
            console.log("submit put");
            let formData = new FormData();
            formData.append("_method", "PUT");
            formData.append("file", this.file);
            axios
                .post("/single-file", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                })
                .then(function (res) {
                    console.log(res);
                })
                .catch(function () {
                    console.log("FAILURE!!");
                });
        },
    },
};
</script>
<style scoped>
.overlay-button {
    position: absolute;
    top: 10px;
    left: 10px;
}
</style>