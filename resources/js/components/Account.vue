<template>
    <div>
        <div v-if="(user.email_verified_at === null) && (user.auth)" :class="send_email? 'alert-success' : 'alert-danger'" class="alert container p-2 rounded">
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
    name: 'account-user',
    components: {
        'user-information': UserInformation,
    },
    props: ['user_id'],
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
            axios.get('/user/user-data/' + this.user_id).then(response =>{
                this.user = response.data;
                this.load = false;
            })
        }
    }
}
</script>

<style scoped>

</style>
