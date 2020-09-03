<template>
    <div class="container border col-3">
        <img src="img/equipment.jpg" height="300" alt="equipment" >
        <div class="overlay-button">
            <button class="btn btn-primary"><i class="fa fa-pencil"></i></button>
        </div>
    </div>
</template>
<script>
export default {
    props:[],
    data(){
        return {
            mess: 'Hello world',
            active:1
        }
    }
}
</script>
<style scoped>
    .overlay-button {
        position:absolute;
        top: 10px;
        left: 10px;
    }
</style>