<template>
    <li class="list-group-item">
<div class="panel panel-primary">
    <div class="panel-heading">

        <div class="panel-title"> <h3>{{ comment.author_name }}</h3></div>
        <a @click="function(){replyToComment = !replyToComment; editComment = false}" class="btn btn-success">Reply</a>

        <a @click="function(){replyToComment = false; editComment = !editComment}" class="btn btn-primary">Edit</a>

        <a href="#"
           class="btn btn-danger"
           @click="deleteEntry(comment.id)">
            Delete
        </a>
    </div>
    <div class="panel-body">
        <div class="form-group">
            {{ comment.comment }}
        </div>
    </div>

    <div class="panel-footer">

        <comment-form v-if="replyToComment  || editComment" :comment="comment" :edit="editComment"></comment-form>
        <comment-list v-if="comment.children" v-bind:comments="comment.children"  ></comment-list>
    </div>
</div>
    </li>
</template>
<script>
    import CommentList from './CommentList.vue';
    import CommentForm from './CommentForm.vue';
    export default{
        props: ['comment' ],
        data(){
            return {
                replyToComment: false,
                editComment: false,
            }
        },
        mounted(){
        },
        components: {
            'comment-list': CommentList,
            'comment-form': CommentForm
        }
    }
</script>
