<template>

<div>

    <div class="col-md-12">
        <comment-form  :comment="comment" :comments="comments"></comment-form>
    </div>
 <div class="col-md-12">
        <comment-list v-if="comments" :comments="comments"></comment-list>
    </div>
    <div class="clearfix"></div>
</div>

</template>

<script>
    import axios from 'axios';
    import CommentList from "./CommentList";
    import CommentForm from './CommentForm.vue';
    export default {
        data: function () {
            return {
                comments: [],
                comment: {
                    post_id: this.$route.params.id,
                    comment_parent_id:'',
                }
            }
        },
        beforeCreate: function () {
            this.$options.components.Comment = require('./Comment.vue')

        },

        mounted(){
            this.getComments(this.$route.params.id);
        },

        watch: {
            // call again the method if the route changes
            '$route': 'getComments'
        },
        components: {
            'comment-list': CommentList,
           'comment-form':CommentForm,
        },
        methods: {
            getComments(post){

                if(post instanceof Object ){post=this.$route.params.id}
                var app = this;
                axios.get('/api/v1/post/'+post+"/list")
                    .then(function (resp) {
                        app.comments = resp.data;
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not load commments");
                    });
            },
            commentEdit(post){
                console.log(post);
                axios.post('/api/comment/update', {comment: post.reply, post_id: post}).then(resp => {
                    if (!resp.data.error) {
                        post.reply = '';

                    }
                });
            },
            deleteEntry(id, index) {
                if (confirm("Do you really want to delete it?")) {
                    var app = this;
                    axios.post('/api/v1/comment/'+id+'/delete')
                        .then(function (resp) {
                            function indexWhere(array, conditionFn) {
                                const item = array.find(conditionFn)
                                return array.indexOf(item)
                            }
                            resp.data.map(function(value){

                                const index = indexWhere(app.commments, item => item.id === value);

                                app.commments.splice(index, 1);
                            })
                        })
                        .catch(function (resp) {
                            alert("Could not delete comment");
                        });
                }
            }

        }
    }
</script>
