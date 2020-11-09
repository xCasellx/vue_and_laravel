<template>
    <div v-if="count" class="card p-0 container ">
        <div class="card-header">
            <h3 class="text-center col">Tweets</h3>
        </div>
        <div class="row card-body">
            <div v-for="tweet in tweets" class="ml-3 row p-3 container-fluid">
                <div class="">
                    <img :src="tweet.user.profile_image_url_https" alt="user image" class="rounded-circle">
                </div>
                <div class="col">
                    {{tweet.full_text}}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "TwitterAPI",
    props: {
        count: {
            default: 10
        },
        twitter: {
            default: null
        }
    },
    data: function () {
        return {
            tweets : []
        }
    },
    mounted() {
        this.loadTweets();
    },
    methods:{
        loadTweets: function () {
            axios.get("/tweets/"+this.twitter+"/"+this.count).then(resposnse => {
               this.tweets = resposnse.data;
            })
        }
    }
}
</script>

<style scoped>

</style>

