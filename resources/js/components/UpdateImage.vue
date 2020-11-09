<template>
    <div class="card">
        <div class=" text-center h3 card-header">Edit Image</div>
        <div class="card-body">
            <b-alert v-if="errors.visible" show variant="danger">
                <div v-for="error_list in errors.array">
                    <ul>
                        <li v-for="error in error_list">{{error}}</li>
                    </ul>
                </div>
            </b-alert>

            <b-alert v-if="success.visible" show variant="success">
                <p>{{success.message}}</p>
            </b-alert>
            <form method="POST" action="/" @submit.prevent="onSubmit" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="image" class="col-md-4 col-form-label text-md-right">New image</label>
                    <div class="col-md-4">
                        <input id="image" type="file" accept=".jpg,.gif,.png" class="form-control-file" @change="onFileLoad($event)" name="image" required autocomplete="image">
                    </div>
                </div>
                    <img class="rounded img" id="user-image" v-bind:src="image"  alt="" style="max-width: 25%">
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: "UpdateImage",
    data: function () {
        return {
            image: '',
            FILE: null,
            errors: {
                visible: false,
                array: []
            },
            success:{
                visible: false,
                message: "",
            },
        }
    },
    mounted() {
        this.load();
    },
    methods:{
        load: function () {
            axios.get("/cabinet/user-update").then(response => {
                this.image = response.data.image;
            })
        },
        onFileLoad: function (e) {
            this.FILE = e.target.files[0]
        },
        onSubmit: function () {
            if(this.FILE !== null) {
                let formData = new FormData();
                formData.append("image",this.FILE);
                axios.post('/cabinet/update/image', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(response => {
                    this.success.visible = true;
                    this.success.message = response.data.message;
                    this.image  = this.image + Math.random();

                }).catch((error) => {
                    this.errors.visible = true;
                    this.errors.array = error.response.data.errors;
                })
            }
        }
    }
}
</script>


