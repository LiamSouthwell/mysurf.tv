
<template>
    <div>
        <div v-for="list in carousels">
            <carousel  :title="list.title" :videos="list.videos"> </carousel>
        </div>
    </div>
</template>

<script>
export default {

    data () {
        return {
        playlists: [],
        carousels: []
        }
    },

    mounted: function () {
            axios
        .get('/fetchtrending')
        .then((response => {
            var arr = {"title": "Trending", "videos": response.data.videos};
            this.carousels.push(arr);
        }));

            axios
        .get('/fetchrecent')
        .then((response => {
            var arr = {"title": "Recent", "videos": response.data.videos};
            this.carousels.push(arr);
        }));
            axios
        .get('/searchPlaylists')
        .then((response => {
            this.playlists = response.data;
            this.playlists.forEach((el) => {
                this.carousels.push({"title":el.title, "videos": el.videos.videos});
            })
        }));
        
    },
    methods: {

    }
}
</script>

<style scoped>

</style>