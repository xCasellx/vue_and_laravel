<template>
    <div>
        <select v-model="id_country" required class="mb-1 form-control" @change="loadRegion()">
            <option></option>
            <option  v-for="country in countries" :value="country.id">{{ country.name }}</option>
        </select>
        <select v-model="id_regions" required class="mb-1 form-control" @change="loadCity()">
            <option></option>
            <option v-for="region in regions" :key="region.id" :value="region.id">{{region.name}}</option>
        </select>
        <select v-model="id_cites" @change="setCityId" required name="town" class="mb-1 form-control" >
            <option></option>
            <option  v-for="city in cites" :value="city.id">{{city.name}}</option>
        </select>

    </div>
</template>

<script>
export default {
    name: 'Location',
    props: {
        id_regions : Number,
        id_country : Number,
        id_cites : Number,
        callback :{
            type: Function,
            default: null
        }
    },
    data: function () {
        return {
            countries: [],
            regions: [],
            cites: [],
        }
    },
    mounted() {
        this.loadCountry();
        if(this.id_regions != null) {
            this.loadRegion();
        }

        if(this.id_cites != null) {
            this.loadCity();
        }
    }
    ,
    methods: {
        setCityId: function () {
            if(this.callback){
                this.callback(this.id_cites);
            }
        },
        loadCountry: function () {
            this.regions = [];
            this.cites = [];
            axios.get('/location/country').then((response) => {
                this.countries = response.data;
            })
        },
        loadRegion: function () {
            this.cites = [];
            axios.get('/location/region/' + this.id_country).then((response) => {
                this.regions = response.data;
            })
        },
        loadCity: function () {
            axios.get('/location/city/' + this.id_regions).then((response) => {
                this.cites = response.data;
            })
        }
    }
}
</script>
