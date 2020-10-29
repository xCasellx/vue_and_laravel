<template>
    <div class="card p-0 container ">
        <div class="card-header">
            <h3 class="text-center col">User information</h3>
        </div>
        <div v-if="!load" class="row card-body ">
            <div class="col" style="">
                <img class="rounded img mx-auto d-block" id="user-image" :src="user.image"  alt="" style="max-width: 100%">
            </div>
            <div class="col border-left border-dark">
                <div  class=" col border-left border-dark">
                    <lable class = "m-3"><strong>Name:</strong> {{user.first_name}}</lable><br>
                    <lable class = "m-3"><strong>Surname:</strong> {{user.second_name}} </lable><br>
                    <lable class = "m-3"><strong>Date of Birth:</strong> {{user.date_of_birth}}</lable><br>
                    <lable class = "m-3"><strong>Email:</strong> {{user.email}}</lable><br>
                    <lable class = "m-3"><strong>Phone:</strong> {{user.phone}}</lable><br>
                    <lable class = "m-3"><strong>Town:</strong> {{user.town.country}}, {{user.town.region}}, {{user.town.city}} </lable>
                </div>
            </div>
        </div>
        <div v-else class="d-flex m-5 justify-content-center">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
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
