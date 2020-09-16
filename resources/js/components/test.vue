<template>
    <div class="container">
        <autocomplete-input></autocomplete-input>
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