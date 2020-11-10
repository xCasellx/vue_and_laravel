<template>
    <div class="card p-0 container " style="min-width: 465px">
        <div class="card-header">
            <h3 class="text-center col">User information</h3>
        </div>
        <div class="row card-body ">
            <div class="col-sm" style="">
                <img class="rounded img mx-auto d-block" @click="$bvModal.show('image')" id="user-image" :src="user.image"  alt="" style="max-width: 100%">
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
        <b-modal id="image"
                 title="Image"
                 size="lg"
                 hide-footer>
            <div class="text-center">
                <img :src="user.image" class="" style="max-width: 100%" alt="user image">
            </div>
        </b-modal>
        <twitter-api v-if="user.twitter" :twitter="user.twitter"/>

    </div>

</template>

<script>
import TwitterApi from "./TwitterApi";
export default {
    name: "UserInformation",
    components: {TwitterApi},
    template: {
        TwitterApi
    },
    props:{
        user:{
            default: [],
        },
    },
}
</script>

<style scoped>

</style>
