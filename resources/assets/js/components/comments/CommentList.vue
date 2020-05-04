<template>
    <ul class="list-group">
        <comment v-for="comment, index in comments" v-bind:key = "index" v-bind:comment="comment" ></comment>
    </ul>
</template>
<script>
    export default{
        props: ['comments'],
        computed:{
        },
        beforeCreate: function () {
            this.$options.components.Comment = require('./Comment.vue')
        }
    }
</script>
