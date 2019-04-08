<template>
    <div>
        <div v-for="(video, index) in videos">

            <div class="col myCol" style="position: relative; display: block; max-width: 960px;">
                <div style="height: 200px; border: 1px solid black">
                    <a href="" :id="'link'+index" style="width: inherit; height: inherit">
                        <img style="width: inherit; height: inherit" src="" :id="'thumbnail'+index"/>
                    </a>
                </div>
            </div>

        </div>
    </div>  
</template>

<style scoped>
    div {
        width: 100%;
        margin-left: 0;
        display: block;
    }

    .myCol {
        padding-bottom: 10px;
        margin-bottom: 20px;
    }
</style>

<script>


    export default {
        data () {
            return {
              videos: ['6023137329001', '6023134167001', '6023123229001'] 
            }
        },
        mounted() {
            console.log('Video List Component mounted.')
            this.loadThumbnails();
            },
        methods:{
            loadThumbnails () {
                axios
            .post('/thumbnail', {videos: this.videos})
            .then((response => {
                console.log(response.data)
                response.data.forEach(function(videoInfo, index){
                    document.getElementById("thumbnail"+index).src = videoInfo.poster;
                    document.getElementById("link"+index).href = 'watch/'+videoInfo.id;
                    //WASIF - there is a lot of info for the video accessible here (title, playtime, tags etc), when fields are available as an overlay I will fill them out. Use console.log(videoInfo) to see what is available. Currently thumbnails also link to a separate page - this will change to single page app standards // 
                });
            }));

            },
        }
    }
</script>