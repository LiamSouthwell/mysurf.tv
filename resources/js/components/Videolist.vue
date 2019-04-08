<template>
    <div>
        <div v-for="(video, index) in videos">

            <div class="col myCol" style="position: relative; display: block; max-width: 960px;">



                <div style="height: 200px; border: 1px solid black">
                    <img style="width: inherit; height: inherit" src="" :id="'thumbnail'+index"/>
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
                });


            }));

            },
        }
    }
</script>