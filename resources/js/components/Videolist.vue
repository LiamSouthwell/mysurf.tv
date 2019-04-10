
<template>
    <div>
        <div v-for="(video, index) in videos">

            <div class="col myCol" style="position: relative; display: block; max-width: 960px;">
                <div style="height: 200px; border: 1px solid black; border-bottom: none;" class="video">
                    <a href="" :id="'link'+index" style="width: inherit; height: inherit">
                        <img style="width: inherit; height: inherit" src="" :id="'thumbnail'+index"/>
                    </a>
                    <div class="videoInfo">
                        <div class="row">
                            <div class="videoSub" :id="'title'+index"> Title </div>
                            <hr>
                        </div>
                        <div class="row">
                            <div class="videoSub half" :id="'date'+index"> Date</div>
                            <div class="videoSub half text-right" :id="'duration'+index"> Duration </div>
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
                    document.getElementById("title"+index).innerHTML = videoInfo.name;
                    document.getElementById("date"+index).innerHTML = videoInfo.created_at.substring(0, 10);
                    var input = videoInfo.duration;
                    input = Math.floor(input / 1000);
                    var seconds = input % 60;
                    input = Math.floor(input / 60);
                    var minutes = input % 60;
                    input = Math.floor(input / 60); 
                    document.getElementById("duration"+index).innerHTML = minutes + ':' + seconds;
                    //WASIF - there is a lot of info for the video accessible here (title, playtime, tags etc), when fields are available as an overlay I will fill them out. Use console.log(videoInfo) to see what is available. Currently thumbnails also link to a separate page - this will change to single page app standards // 
                });
            }));

            },
        }
    }
</script>