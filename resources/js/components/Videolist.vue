
<template>
    <div>
        <div v-for="(video, index) in videos">

            <div class="col myCol" style="position: relative; display: block; max-width: 960px;">
                <div style="height: 200px; border: 1px solid black; border-bottom: none;" class="video">
                    <a :href="'/watch/'+video.id" :id="'link'+index" style="width: inherit; height: inherit">
                        <img style="width: inherit; height: inherit" :src="video.poster" :id="'thumbnail'+index"/>
                    </a>
                    <div class="videoInfo">
                        <div class="row">
                            <div class="videoSub" :id="'title'+index"> {{video.name}} </div>
                            <hr>
                        </div>
                        <div class="row">
                            <div class="videoSub half" :id="'date'+index"> {{video.published_at}}</div>
                            <div class="videoSub half text-right" :id="'duration'+index"> {{video.duration}} </div>
                            <div style="height: 0;">&nbsp;</div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>  
</template>

<style scoped>
    hr{
        margin-top: 0;
        margin-bottom: 0;
    }
    .row{
        width: 95%;
        margin: auto;
    }
    .video{

    }
    .half{
        width: 50%;
        float: left;

    }

    .text-right{
        text-align: right;
    }

    .videoSub{
        padding: 0;
        margin: 0;
        font-size: 12px;
    }
    .videoInfo{
        background-color: rgba(255,255,255,0.3);
        width: inherit;
        outline: 1px solid black;
    }

    div {
        width: 100%;
        margin-left: 0;
        display: block;
    }

    .myCol {
        padding-bottom: 10px;
        margin-bottom: 55px;
    }

    .addBtn {
        display: flex;
        justify-content: flex-end;
        width: 100%;
        padding: 0;
    }

    .videoDetails{
        text-align: center;
    }
</style>

<script>


    export default {
        data () {
            return {
              videos: 0
            }
        },
        mounted() {
            console.log('Video List Component mounted.')
            this.loadThumbnails();
        },
        methods:{
            loadThumbnails () {
                    axios
                .post('/search', {terms: "surfing"})
                .then((response => {
                    this.videos = response.data.videos;
                }));
            },
        }
    }
</script>