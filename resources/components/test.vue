<template>
    <div>
        <h2>{{mess}}</h2>
        <div class="tabplus">
            <ul>
                <li><a @click="active = 1"  :class="active == 1?'active':''">Home</a></li>
                <li><a @click="active = 2"  :class="active == 2?'active':''">About</a></li>
                <li><a @click="active = 3"  :class="active == 3?'active':''">Contact</a></li>
            </ul>
            <div>
                <div v-show="active == 1">Content 1</div>
                <div v-show="active == 2">Content 2</div>
                <div v-show="active == 3">Content 3</div>
            </div>
            <div v-if="active == 2">
                <div v-for="template in templates" :key="template.id">{{template.name}}</div>
            </div>
            <div v-else>
                noi dung thu 2
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:['ids', 'templates'],
    data(){
        return {
            mess: 'Hello world',
            active:1
        }
    }
}
</script>
<style scoped>
.tabplus{
    width:500px;
    margin: 100px auto;
}
.tabplus > ul{
    list-style: none;
}
.tabplus > ul > li {
    display:inline-block;
    border:1px solid #dedede;
}
.tabplus > ul > li > a {
    cursor: pointer;
    display:inline-block;
    padding:10px 15px;
}
.tabplus > div{
    border:1px solid #dedede;
    padding:15px;
}
.active{
    background-color:coral;
}
</style>