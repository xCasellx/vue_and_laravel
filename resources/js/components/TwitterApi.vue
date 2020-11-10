<template>
    <div v-if="!load" class="card p-0 container bg-white">
        <div class="card-header p-1 m-1 bg-primary text-white">
            <h3 class="text-center col">Tweets</h3>
        </div>
        <div class="row card-body">
            <div v-for="tweet in tweets" class=" mt-2 mr-3 mb-0  row p-3 container-fluid">
                <div style="min-width: 64px">
                    <img :src="tweet.user.profile_image_url_https" alt=" user image"
                         class="img rounded-circle mx-auto d-block" >
                </div>
                <div class="col ">
                    <div class="row border-bottom border-dark text-dark">
                        <small class="w-50 ">{{tweet.user.name}}  @{{tweet.user.screen_name}}</small>
                        <small class="w-50 text-right ">{{tweet.created_at.replace("+0000 ", "")}}</small>
                    </div>
                    <div class="mt-2">
                        {{tweet.full_text}}
                    </div>
                    <div class="row text-dark">
                        <a class="w-100 text-decoration-none text-right small" :href="'https://mobile.twitter.com/'+tweet.user.screen_name+'/status/'+tweet.id_str">view twitter</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div v-else class="text-center container bg-white p-5">
        <b-spinner  class="justify-content-center" style="width: 3rem; height: 3rem;" label="load..."></b-spinner>
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
            tweets : [],
            load: true,
        }
    },
    mounted() {
        this.loadTweets();
    },
    methods:{
        loadTweets: function () {
            axios.get("/tweets/"+this.twitter+"/"+this.count).then(resposnse => {
               this.tweets = resposnse.data;
               this.load = false;
            })
        }
    }
}
</script>

<style scoped>
    @media (min-width: 576px) {

    }
</style>

