<template>
    <div class="card p-0 container ">
        <div v-if="user.email_verified_at === null" class="row alert-danger p-2 rounded">
            <a class="text-decoration-none text-danger" href="/email/verify">Click to confirm mail</a>
        </div>
        <div class="card-header">
            <h3 class="text-center col">User information</h3>
        </div>
        <div v-if="!load" class="row card-body ">
            <div class="col-sm" style="">
                <img class="rounded img mx-auto d-block" id="user-image" :src="user.image"  alt="" style="max-width: 100%">
            </div>
            <div class="col-sm ">
                <div class="justify-content-center">
                    <b-list-group>
                        <b-list-group-item>
                            <strong>Name:</strong> {{user.first_name}}
                        </b-list-group-item>
                        <b-list-group-item>
                            <strong>Surname:</strong> {{user.second_name}}
                        </b-list-group-item>
                        <b-list-group-item>
                            <strong>Date of Birth:</strong> {{user.date_of_birth}}
                        </b-list-group-item>
                        <b-list-group-item>
                            <strong>Email:</strong> {{user.email}}
                        </b-list-group-item>
                        <b-list-group-item>
                            <strong>Phone:</strong> {{user.phone}}
                        </b-list-group-item>
                        <b-list-group-item>
                            <strong>Town:</strong> {{user.town.country}}, {{user.town.region}}, {{user.town.city}}
                        </b-list-group-item>
                    </b-list-group>
                </div>
            </div>
        </div>
        <div v-else class="text-center p-5">
            <b-spinner  class="justify-content-center" style="width: 3rem; height: 3rem;" label="load..."></b-spinner>
        </div>
    </div>
</template>

<script>

export default {
    name: "UserCabinet",
    data: function () {
        return{
            user: [],

            load: true,
        }
    },
    mounted() {
        this.loadData();
    },
    methods:{
        loadData: function () {
            axios.get("/cabinet/user-data").then(response => {
                this.user = response.data;
                this.load = false;
            })
        }
    }

}
</script>

<style scoped>

</style>
