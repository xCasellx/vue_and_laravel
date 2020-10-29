<template>
    <div>
        <select required class="mb-1 form-control" @change="loadRegion($event)">
            <option></option>
            <option  v-for="country in countries" :value="country.id">{{ country.name }}</option>
        </select>
        <select required class="mb-1 form-control" @change="loadCity($event)">
            <option ></option>
            <option  v-for="region in regions" :key="region.id" :value="region.id">{{region.name}}</option>
        </select>
        <select required name="town" class="mb-1 form-control" >
            <option ></option>
            <option  v-for="city in cites" :value="city.id">{{city.name}}</option>
        </select>
    </div>
</template>

<script>
export default {
    name: "Location",
    data: function () {
        return {
            countries: [],
            regions: [],
            cites: [],
        }
    },
    mounted() {
        this.loadCountry();
    }
    ,
    methods: {
        loadCountry: function () {
            this.regions = [];
            this.cites = [];
            axios.get("/location/country").then((response) => {
                this.countries = response.data;
                this.selectRegion = false;
            })
        },
        loadRegion: function (id) {
            this.cites = [];
            axios.get("/location/region/"+id.target.value).then((response) => {
                this.regions = response.data;
            })
        },
        loadCity: function (id) {
            axios.get("/location/city/"+id.target.value).then((response) => {
                this.cites = response.data;
            })
        }
    }
}
</script>
