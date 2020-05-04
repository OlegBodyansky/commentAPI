<template>
    <div>
        <h1>Vue Router Demo App</h1>

        <p>
            <router-link :to="{ name: 'home' }">Home</router-link> |
        <span class ="category-list" v-for="post_id in postIds">
        <router-link :to="{ name: 'post', params: {'id':post_id}}">Post-{{post_id}}</router-link> |
        </span>
    </p>

    <div class="container">
        <router-view></router-view>
    </div>
    </div>
</template>
<script>


        import axios from 'axios';
    export default{
        data(){
            return{
                postIds: ''
            }
        },
        mounted(){
            this.getPosts();
        },
        methods:{
            getPosts(){
                var app = this;
                axios.get('/api/v1/posts/').then(function (resp) {
                    app.postIds = resp.data;
                })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not load posts");
                    });
            }
        }
    }

</script>
