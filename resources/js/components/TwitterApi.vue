<template>
    <div class="card p-0 container bg-white">
        <div class="card-header p-1 m-1 bg-primary text-white">
            <h3 class="text-center col">Tweets</h3>
        </div>
        <div class="row card-body">
            <div v-for="tweet in tweets" class=" mt-2 mr-3 ml-3 mb-0  row p-3 container-fluid">
                <div class="col-1">
                    <img :src="tweet.user.profile_image_url_https" alt=" user image"
                         class="img-fluid mx-auto d-block rounded-circle">
                </div>
                <div class="col-11">
                    <div class="row border-bottom border-dark text-dark">
                        <small class="ml-1 ">{{tweet.user.name}}  @{{tweet.user.screen_name}}</small>
                        <small class="offset-8 ">{{tweet.created_at.replace("+0000 ", "")}}</small>
                    </div>
                    <div class="row mt-2">
                        {{tweet.full_text}}
                    </div>
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

