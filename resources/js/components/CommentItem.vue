<template>
    <div  class="container mt-2">
        <div class="card p-0 comments">
            <div class="p-1 card-header bg-dark text-light row" >
                <div class="col-1 p-0" style="max-width: 32px">
                    <img class="comment-img rounded m-0 img-fluid img" @click="image" :src="comment_parent.image" style="width: 32px;height: 32px;">
                </div>
                <a :href="'/user/'+comment_parent.user_id" class="col  text-decoration-none text-white">{{comment_parent.first_name}} {{comment_parent.second_name}}</a>
                <small class="col text-right date-comment">{{comment_parent.created_at}}</small>
            </div>
            <div class="p-1 card-body comments-text">
                {{ comment_parent.text}}
            </div>

            <div class="row p-0 m-0 card-footer bg-dark">
                <div v-if="comment_parent.child.length !== 0"  class="col">
                    <button   @click="show = !show"
                         class="btn m-0 p-0 text-white"
                    >   <strong v-if="!show">show</strong>
                        <strong v-else>hide</strong></button>
                </div>
                <div class="col text-right">
                    <a href="#" @click='response'
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
        </div>
        <transition name="slide-fade">
            <div v-if="show" class="ml-2" v-for="comment in comment_parent.child">
                <comment-item
                    :edit-modal="editModal"
                    :response-modal="responseModal"
                    :delete-modal="deleteModal"
                    :comment_parent="comment"/>
            </div>
        </transition>
    </div>
</template>

<script>
import CommentItem from './CommentItem';
export default {
    data: function () {
      return {
          show: false,
      }
    },
    components: {
        CommentItem
    },
    name: 'CommentItem',
    props: {
        'comment_parent': String,
        'editModal': Function,
        'responseModal': Function,
        'deleteModal': Function,
        'imageModal': Function,
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
        },
        image: function () {
            this.imageModal(this.comment_parent.image);
        }
    },
}
</script>

<style scoped>
    .slide-fade-enter-active {
        transition: all .3s ease;
    }
    .slide-fade-leave-active {
        transition: all .3s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }
    .slide-fade-enter, .slide-fade-leave-to {
        transform: translateY(-10px);
        opacity: 0;
    }
</style>
