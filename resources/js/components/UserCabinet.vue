<template>
    <div>
        <div v-if="user.email_verified_at === null" class="alert-danger container p-2 rounded">
            <a class="text-decoration-none text-danger" href="/email/verify">Click to confirm mail</a>
        </div>
        <user-information v-if="!load" :user="user" />
        <div v-else class="text-center container bg-white p-5">
            <b-spinner  class="justify-content-center" style="width: 3rem; height: 3rem;" label="load..."></b-spinner>
        </div>
    </div>
</template>

<script>
import UserInformation from "./UserInformation";
export default {
    components: {
        "user-information": UserInformation,
    },
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
            axios.get("/user/user-data").then(response =>{
                this.user = response.data;
                this.load = false;
            })
        }
    }

}
</script>

<style scoped>

</style>
