<template>
    <div>
        <div>
            <div class="container bg-white p-3 mb-4 rounded">
                <form class="m-3 form-comment" method="POST" action="/" @submit.prevent="createComment">
                <div class="">
                    <textarea required name="text" v-model="text" rows="10" maxlength="512" class="form-control"></textarea>
                </div>
                <div class="mt-2 form-group row mb-0">
                    <div class="col-md-6 offset-md-0">
                        <button type="submit" class="create-btn btn btn-info">
                            Send
                        </button>
                    </div>
                </div>
                </form>
            </div>

            <b-modal id="response"
                     title="Response"
                     size="xl"
                     @hide="closeModal"
                     hide-footer>
                <form class="m-3 form-comment" method="POST" action="/" @submit.prevent="createComment(null)">
                    <div class="">
                        <textarea required name="text" v-model="text" rows="10" maxlength="512" class="form-control"></textarea>
                    </div>
                    <div class="mt-2 form-group row mb-0">
                        <div class="col-md-6 offset-md-0">
                            <button type="submit" class="create-btn btn btn-info">
                                Send
                            </button>
                        </div>
                    </div>
                </form>
            </b-modal>

            <b-modal id="edit"
                     title="Edit"
                     @hide="closeModal"
                     size="xl"
                     hide-footer>
                <form method="POST" action="/" @submit.prevent="editComment">
                    <div >
                        <textarea required name="text" v-model="text_edit" rows="10" maxlength="512" class="form-control"></textarea>
                    </div>
                    <div class="mt-2 form-group row mb-0">
                        <div class="col-md-6 offset-md-0">
                            <button type="submit" class="btn btn-info">Save</button>
                        </div>
                    </div>
                </form>
            </b-modal>

            <b-modal id="delete"
                     title="Delete"
                     @hide="closeModal"
                     hide-footer>
                <div class="text-center">
                    <button type="button" class="btn btn-danger" @click="deleteComment">Delete</button>
                    <button type="button" class="btn btn-info" @click="$bvModal.hide('delete')">Close</button>
                </div>
            </b-modal>

            <b-modal id="image"
                     title="Image"
                     @hide="image"
                     size="lg"
                     hide-footer>
                <div class="text-center">
                    <img :src="image" class="" style="max-width: 100%" alt="user image">
                </div>
            </b-modal>
        </div>
        <div class="mt-3 justify-content-center container">
            <b-pagination
                v-model="currentPage"
                :total-rows="rows"
                :per-page="perPage"
                align="center"
                @input="loadComments"
            ></b-pagination>
        </div>
        <div v-if="!load">
            <div v-for="comment in comment_list">
                <comment-item
                    :edit-modal="editModal"
                    :response-modal="responseModal"
                    :delete-modal="deleteModal"
                    :image-modal="imageModal"
                    :comment_parent = "comment"/>
            </div>
        </div>
        <div v-else class="text-center container bg-white p-5">
            <b-spinner  class="justify-content-center" style="width: 3rem; height: 3rem;" label="load..."></b-spinner>
        </div>
    </div>
</template>

<script>
import CommentItem from './CommentItem';
export default {
    components:{
        'comment-item': CommentItem,
    },
    name: 'Comments',
    data:function () {
        return {
            rows: null,
            perPage: 1,
            currentPage: 1,

            comment_list: null,
            text: '',
            text_edit: '',
            id: null,
            load: true,
            image: ''
        }
    },
    mounted() {
      this.loadComments();
    },
    methods:{
        closeModal: function () {
            this.text_edit =  '';
            this.id = null;
            this.image = '';
        },
        editModal: function (id, text) {
            this.id = id;
            this.text_edit = text;
            this.$bvModal.show('edit');

        },
        responseModal: function (id) {
            this.id = id;
            this.$bvModal.show('response');
        },
        deleteModal: function (id) {
            this.id = id;
            this.$bvModal.show('delete');
        },
        imageModal: function (image) {
            this.image = image;
            this.$bvModal.show('image');
        },
        createComment: function() {
            axios.post('/comments/create', {
                parent_id: this.id,
                text: this.text
            }).then(response => {
                this.text =  '';
                this.loadComments();
                this.$bvModal.hide('response');
            });
        },
        editComment: function() {
            axios.post('/comments/update', {
                comment_id: this.id,
                text: this.text_edit
            }).then(response => {
                this.loadComments();
                this.$bvModal.hide('edit');
            });
        },
        deleteComment: function() {
            axios.get('/comments/delete/' + this.id,
            ).then(response => {
                this.loadComments();
                this.$bvModal.hide('delete');
            });
        },
        loadComments: function () {
            this.load = true;
            axios.get('/comments/read/5?page=' + this.currentPage).then(response => {
                this.comment_list = response.data.data;
                this.rows = response.data.last_page;
                this.load = false;
            })
        }
    }
}
</script>

<style scoped>

</style>
