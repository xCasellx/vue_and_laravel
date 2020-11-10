<template>
    <div class="card">
        <div class="text-center h3 card-header">Edit password</div>
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

            <form action="/cabinet/update/password" method="post" @submit.prevent="editPassword($event)">
                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password"
                               v-model="password" required autocomplete="password" autofocus>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="new-password" class="col-md-4 col-form-label text-md-right">New Password</label>
                    <div class="col-md-6">
                        <input id="new-password" type="password" class="form-control" name="new_password"
                               v-model="new_password" required autocomplete="password" autofocus>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="new_password_confirmation" class="col-md-4 col-form-label text-md-right">Password Confirmation</label>
                    <div class="col-md-6">
                        <input id="new_password_confirmation" type="password" class="form-control" name="new_password_confirmation"
                               v-model="new_password_confirmation" required autocomplete="new_password_confirmation" autofocus>
                    </div>
                </div>

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
    name: 'UpdatePassword',
    data: function () {
        return{
            password: '',
            new_password: '',
            new_password_confirmation: '',
            errors: {
                visible: false,
                array: []
            },
            success:{
                visible: false,
                message: '',
            },
        }
    },
    methods: {
        editPassword: function (e) {
            axios.post('/cabinet/update/password', {
                password: this.password,
                new_password: this.new_password,
                new_password_confirmation: this.new_password_confirmation,
            }).then(response => {
                console.log(response.data)
                this.success.visible = true;
                this.success.message = response.data.message;

            }).catch((error) => {
                this.errors.visible = true;
                this.errors.array = error.response.data.errors;
            })
        }
    }
}
</script>

<style scoped>

</style>
