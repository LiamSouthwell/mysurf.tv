<template>
    <div>
        <div v-for="video in videos">

            <div class="col myCol" style="position: relative; display: block; max-width: 960px;">
                <div style="padding-top: 2.25%; height: 200px;">
                <video data-video-id="6023123229001" 
                data-account="6022296345001" 
                data-player="ExFAwNTvB" 
                data-embed="default" 
                data-application-id 
                class="video-js" 
                controls 
                style="position: absolute; inset: 0px; width: 100%; height: 100%;"
                id="player">
                </video>
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
            .get('/thumbnail')
            .then(response => (
                console.log(response.data.poster)
                

                
                ));

            },
        }
    }
</script>