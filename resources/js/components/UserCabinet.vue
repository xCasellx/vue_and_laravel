<template>
    <div>
        <div v-if="user.email_verified_at === null" :class="send_email? 'alert-success' : 'alert-danger'" class="alert container p-2 rounded">
            <button v-show="!send_email" @click="confirmEmail" class="ml-1 btn btn-link text-danger">Click to confirm mail</button>
            <div v-show="send_email" class="ml-1">
                A confirmation link has been sent to your email address.
            </div>
        </div>
        <user-information v-if="!load" :user="user"/>
        <div v-else class="text-center container bg-white p-5">
            <b-spinner class="justify-content-center" style="width: 3rem; height: 3rem;" label="load..."></b-spinner>
        </div>
    </div>
</template>

<script>
import UserInformation from './UserInformation';
export default {
    components: {
       'user-information': UserInformation,
    },
    name: 'UserCabinet',
    data: function () {
        return{
            user: [],
            load: true,
            send_email: false,
        }
    },
    mounted() {
        this.loadData();
    },
    methods:{
        loadData: function () {
            axios.get('/user/user-data').then(response =>{
                this.user = response.data;
                this.load = false;
            })
        },
        confirmEmail: function () {
            axios.post('/email/resend').then(response => {
                this.send_email = true;
            })
        }
    }
}
</script>

<style scoped>

</style>
