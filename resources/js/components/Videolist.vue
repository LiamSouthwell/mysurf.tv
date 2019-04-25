
<template>
    <div>
        <div class="videoList" v-for="(video, index) in videos">
            <div class="row vids">
            <div class="col myCol" style="display: block;">
                <div style="height: 240px; border: 1px solid black; border-bottom: none;" class="video">
                    <a :href="'/watch/'+video.id" :id="'link'+index" style="width: inherit; height: inherit">
                        <img style="width: inherit; height: inherit" :src="video.poster" :id="'thumbnail'+index"/>
                    </a>
            </div>
                    <div class="videoInfo" style="height: 40px;">
                        <div class="row">
                            <div class="videoSub" :id="'title'+index"> {{video.name}} </div>
                            <hr>
                        </div>
                        <div class="row" >
                            <div class="videoSub half" :id="'date'+index"> {{video.published_at}}</div>
                            <div class="videoSub half text-right" :id="'duration'+index"> {{video.duration}} </div>
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
        border-top: 1px solid rgba(0,0,0,.3);
    }
    .row{
        width: 95%;
        margin: auto;
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
        font-weight: bold;
    }
    .videoInfo{
        background-color: rgba(255,255,255,0.3);
        width: inherit;
        outline: 1px solid black;
        overflow: hidden;
        white-space: nowrap;
    }

    div {
        width: 100%;
        margin-left: 0;
        display: block;
    }

    .myCol {
        height: 280px;
        padding-bottom: 10px;
        margin-bottom: 25px;
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

    @media only screen and (min-width: 600px) {
        .vids {
            display: inline-flex;
            padding: 10px;
        }
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