<template>
    <div class="card">
        <div class=" text-center h3 card-header">Edit data</div>
        <div v-if="!load" class="card-body">
            <b-alert v-if="errors.visible" show variant="danger">
                <div v-for="error_list in errors.array">
                    <ul>
                        <li v-for="error in error_list">{{error}}</li>
                    </ul>
                </div>
            </b-alert>

            <b-alert v-if="success.visible" show variant="success">
                <ul>
                    <li>{{success.message}}</li>
                </ul>
            </b-alert>

            <form method="POST" action="/cabinet/update/user" @submit.prevent="editData($event)">

                <div class="form-group row">
                    <label for="first_name" class="col-md-4 col-form-label text-md-right">First Name</label>
                    <div class="col-md-6">
                        <input id="first_name" type="text" class="form-control" name="first_name"
                               v-model="user.first_name" required autocomplete="first_name" autofocus>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="second_name" class="col-md-4 col-form-label text-md-right">Second Name</label>
                    <div class="col-md-6">
                        <input id="second_name" type="text" class="form-control" name="second_name"
                               v-model="user.second_name" required autocomplete="second_name" autofocus>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email"
                               v-model="user.email" required autocomplete="email" autofocus>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-md-4 col-form-label text-md-right">Phone</label>
                    <div class="col-md-6">
                        <input id="phone" type="tel" class="form-control" name="phone"
                               v-model="user.phone" required autocomplete="phone" autofocus>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Town" class="col-md-4 col-form-label text-md-right">Town</label>
                    <div class="col-md-6">
                        <location-select
                            :id_country = "user.town_id.country_id"
                            :id_regions = "user.town_id.region_id"
                            :id_cites = "user.town_id.city_id"
                            :callback = "getCityId"
                        />
                    </div>
                </div>

                <div class="form-group row">
                    <label for="first_name" class="col-md-4 col-form-label text-md-right">Twitter ID</label>
                    <div class="col-md-6">
                        <input id="twitter" type="text" class="form-control" name="twitter"
                               v-model="user.twitter" autocomplete="twitter" autofocus>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="date_of_birth" class="col-md-4 col-form-label text-md-right">Date Of Birth</label>
                    <div class="col-md-6">
                        <input id="date_of_birth" type="date" class="form-control"
                               name="date_of_birth" v-model ="user.date_of_birth" required>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
        <div v-else class="text-center p-5">
            <b-spinner  class="justify-content-center" style="width: 3rem; height: 3rem;" label="load..."></b-spinner>
        </div>
    </div>

</template>

<script>
export default {
    name: "UserUpdate",
    data: function () {
        return{
            user: [],
            errors: {
                visible: false,
                array: []
            },
            success:{
                visible: false,
                message: "",
            },
            load: true,
        }
    },
    mounted() {
        this.loadData();
    },
    methods:{
        getCityId: function (city_id) {
            this.user.city_id = city_id;
        },
        loadData: function () {
            axios.get("/cabinet/user-update").then(response => {
                this.user = response.data;
                this.user.city_id = this.user.town_id.city_id;
                this.load = false;
            })
        },
        editData: function (e) {

            axios.post("/cabinet/update/user", this.user).then(response => {
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

