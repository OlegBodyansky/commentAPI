<template>
    <div class="comment_block col-md-8">
        <div class="form-group">
            <label class="control-label" for="author_name">Author name</label>
                <input type="text" :id="author_name" v-model="author_name" class="form-control">

        </div>
        <div class="form-group">
            <label class="control-label" for="comment_text">Comment</label>
                <input type="text" v-bind:id="comment_text" v-model="comment_text" class="form-control"
                       v-on:keyup.enter="updateComment(comment)">
        </div>
    </div>
</template>
<style>
</style>
<script>
    import axios from 'axios';
    export default{
        props: ['comment', 'comments', 'edit'],
        data(){
            return{
                comment_text: this.edit?this.comment.comment:'',
                author_name:''
            }
        },

        methods: {
            updateComment(comment) {
                if (this.edit = true) {
                    axios.post('/api/v1/comment/update', {
                        id: comment.id,
                        comment: this.comment_text,
                        author_name: this.author_name==undefined ? this.author_name:'incognito',
                    }).then(resp => {
                        this.comment_text = this.author_name = '';
                        if (!resp.data.error) {
                            this.comment_text = this.author_name = '';
                            comment.comment = resp.data.comment
                            comment.author_comment=resp.data.author_comment
                        }
                    });
                } else {
                    axios.post('/api/v1/comment/create', {
                        comment: this.comment_text,
                        author_name: this.author_name,
                        post_id: comment.post_id,
                        comment_parent_id: comment.id
                    }).then(resp => {
                        this.comment_text = this.author_name = '';
                        if (!resp.data.error) {
                            this.comment_text = this.author_name = '';

                            if (comment.comment_parent_id != '') {
                                comment.children.unshift(resp.data)
                            } else {

                                this.comments.unshift(resp.data)
                            }
                        }
                    });
                }
            }
        }
    }
</script>
