<template>
    <div>
        <b-dropdown @show="loadData" id="dropdown-aria" text="Profile" variant="secondary" class="m-2">
            <div v-if="!load">
                <b-dropdown-text><b-avatar :src="user.image"/></b-dropdown-text>
                <b-dropdown-text>
                    {{user.first_name}} {{user.second_name}}
                </b-dropdown-text>
            </div>
            <b-dropdown-divider></b-dropdown-divider>
            <b-dropdown-item href="/user/update">
                Edit profile
            </b-dropdown-item>
            <b-dropdown-divider></b-dropdown-divider>
            <b-dropdown-item variant="danger" href="/logout">
                Logout
            </b-dropdown-item>
        </b-dropdown>
    </div>
</template>

<script>
export default {
    name: 'NavUserData',
    data: function () {
        return{
            user: [],
            load : true,
        }
    },
    mounted() {
        this.loadData();
    },
    methods:{
        loadData: function () {
            axios.get('/user/user-data/').then(response => {
                this.user = response.data;
                this.load = false;
            })
        },

    }
}
</script>
