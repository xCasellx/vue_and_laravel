<template>
    <div  class="container ">
        <div class = 'card p-0 comments'>
            <div class =' p-1 card-header bg-dark text-light row' >
                <div class ='col-1 p-0' style="max-width: 32px">
                    <img class ='comment-img rounded m-0 img-fluid img' :src='comment_parent.image' style='width: 32px;height: 32px;' alt=''>
                </div>
                <h6 class='col '>{{comment_parent.first_name}} {{comment_parent.second_name}}</h6>
                <small class='col text-right date-comment' >{{comment_parent.created_at}}</small>
            </div>
            <div class='p-1 card-body comments-text'>
                {{ comment_parent.text}}
            </div>
            <div class='p-1 pr-2 m-0 card-footer bg-dark text-right'>
                <a href="#" @click="response"
                   class="pr-2 float-right text-decoration-none"
                ><strong>response</strong></a>
                <a v-if="comment_parent.access" href="#" @click="edit"
                   class="pr-2 float-right text-warning text-decoration-none"
                ><strong>edit</strong></a>
                <a v-if="comment_parent.access" href="#" @click="remove"
                   class="pr-2 float-right text-danger text-decoration-none"
                ><strong>delete</strong></a>
            </div>
        </div>
        <div class="ml-2" v-for="comment in comment_parent.child">
            <comment-item
                :edit-modal="editModal"
                :response-modal="responseModal"
                :delete-modal= "deleteModal"
                :comment_parent = "comment"/>
        </div>
    </div>
</template>

<script>
import CommentItem from "./CommentItem";
export default {
    components:{
        CommentItem
    },
    name: "CommentItem",
    props: {
        "comment_parent": "",
        "editModal" :{
            type: Function
        },
        "responseModal" :{
            type: Function
        },
        "deleteModal" :{
            type: Function
        }
    },
    methods:{
        edit: function () {
            this.editModal(this.comment_parent.id, this.comment_parent.text);
        },
        response: function () {
            this.responseModal(this.comment_parent.id);
        },
        remove: function () {
            this.deleteModal(this.comment_parent.id);
        }
    },
}
</script>

<style scoped>

</style>
