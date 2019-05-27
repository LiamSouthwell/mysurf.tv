
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
        document.body.style.backgroundColor = "#e6e6e6";
        document.body.style.color = "#212529";
    },
    methods: {

    }
}
</script>

<style scoped>
    .carousel{
        width: 85%;
        margin: auto;
        padding-bottom: 65px;
        padding-top: 65px;
    }
    img{
        display: block;
        max-width: 100%;
        height: auto !important;
        vertical-align: middle;
    }
    .carousel-item{

        max-height: 320px;
        overflow: hidden; 
    }
</style>