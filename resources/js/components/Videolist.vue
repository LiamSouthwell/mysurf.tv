
<template>
    <div>
        <div v-if="this.loading">
            <loader> </loader>
        </div>
        <div v-else class="col-lg-4 videoList" v-for="(video, index) in videos">
            <div class="row vids">
            <div class="col myCol">
                <div style="height: 240px; width: 300px; border: 1px solid black; border-bottom: none;" class="video">
                    <router-link :to="'/watch/'+video.id" :id="'link'+index" style="width: inherit; height: inherit">
                        <img style="width: inherit; height: inherit" :src="video.poster" :id="'thumbnail'+index"/>
                    </router-link>
                <div class="title" style="width: inherit;">{{video.name}}</div>
            </div>
            <div class="videoInfo">
                <div class="vidName"> {{video.name}} </div>
                <hr>
                <div class="videoSub half" :id="'date'+index"> {{video.published_at}}</div>
                <div class="videoSub half text-right" :id="'duration'+index"> {{((video.duration/1000)/60).toFixed(0)}}:{{((video.duration/1000)%60).toFixed(0)}} </div>
            </div>
            </div>
            </div>
        </div>

    </div>  
</template>

<style scoped>

    .videoList {
        float: left;
    }

    hr{
        margin-top: 0;
        margin-bottom: 0;
        border-top: 1px solid rgba(0,0,0,.3);
    }
    
    .row{
        width: 95%;
        margin: auto;
    }

    .text-right{
        text-align: right;
        margin-right: 5px;
        width: 20%;
        float: right;
    }

    .videoSub{
        padding: 0;
        margin-left: 5px;
        font-size: 11px;
        font-weight: bold;
    }

    .videoInfo{
        background-color: rgba(255,255,255,0.3);
        width: 300px;
        height: 70px;
        outline: 1px solid black;
        overflow: hidden;
        word-wrap: break-word;
    }
      .title {
      font-size: 15px;
      text-align: center;
      width: 100%;
      color: white;
      position: absolute;
      top: 10px;
      left: 15px;
      transform: scaleY(0);
      transition: transform .3s;
  }

    .myCol:hover .title {
    transform: scaleY(1);
    background-image: linear-gradient(black, rgba(255,0,0,0));
  }

  .vidName {
      height: 40px;
      text-align: center;
      font-size: 14px;
      font-weight: bold;
  }

    div {
        width: 100%;
        margin-left: 0;
        display: block;
    }

    .myCol {
        height: 280px;
        padding-bottom: 10px;
        margin-bottom: 60px;
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

    @media only screen and (min-width: 900px) {
        .container {
            align-content: flex-start;
        }

        .vids {
            display: flex;
            flex-flow: row wrap;
        }
    }

</style>

<script>
    export default {
        
        data () {
            return {
            terms: "",
            videos: 0,
            loading: true
            }
        },
        mounted() {
            this.loadThumbnails();
        },
        watch:{
            $route (to, from){
                this.terms = this.$route.params.terms;
                this.loadThumbnails();
            }
        },
        methods:{
            loadThumbnails () {
                this.loading = true;
                if(this.terms == ""){
                    this.terms = "surfing";
                }

                    axios
                .post('/search', {terms: this.terms})
                .then((response => {
                    this.videos = response.data.videos;
                    this.loading = false;
                }));
            },
        }
    }
</script>