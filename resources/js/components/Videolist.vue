
<template>
    <div>
        <h2  id="header" v-if="$route.params.id != null" >Related</h2>
        <h2  id="header" v-else>Trending</h2>
        <div v-if="this.loading">
            <loader> </loader>
        </div>
        <div v-else class="col-lg-3 col-md-4 col-sm-6 videoList" v-for="(video, index) in videos">
            <div class="row vids">
                <div class="col myCol">
                    <div class="video embed-responsive-item">
                        <router-link :to="'/watch/'+video.id" :id="'link'+index" style="width: inherit; height: inherit">
                          <figure class="sixteen-nine-img"> 
                            <img style="width: inherit; height: inherit; " :src="video.thumbnail" :id="'thumbnail'+index"/>
                          </figure>

                        <div class="titlewrap">
                            <h4 class="title">{{video.name}}</h4>
                        </div>

                        <div class="footerwrap">
                            <h4 class="footerinfo">{{msToTime(video.duration)}}</h4>
                            <h4 class="footerinfo pull-right">{{createdAt(video.created_at)}}</h4>
                        </div>
                        </router-link>
                    </div>
                </div>
            </div>
        </div>

    </div>  
</template>

<style scoped>
    figure.sixteen-nine-img {
      width: 100%;
      overflow: hidden;
      margin: 0;
      padding-top: 56.25%;
      position: relative;
    }
    
    figure.sixteen-nine-img img {
      position: absolute;
      top: 50%;
      left: 50%;
      width: 100%;
      transform: translate(-50%, -50%);
    }

    .videoList {
        float: left;
    }

    #header{
        text-align: center; 
        font-weight: bold; 
        padding-bottom: 15px;
        color: #2d3f51;
        border-top: 1px solid grey;
        padding-top: 20px;
    }
    
    .row{
        width: 98%;
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

    .titlewrap{
        position: absolute;
        margin: auto;
        transform: scaleY(0);
        transition: transform .3s;
        background-image: linear-gradient(#1995AD, rgba(255,0,0,0));
        white-space: pre-wrap;
        width: 100%;
        position: absolute;
        top: 0px;
        left: 0px;
        transform: scaleY(1);
        height: 50%;
    }

    .pull-right{
        text-align: right !important;
    }

    .footerwrap{
        position: absolute;
        margin: auto;
        transform: scaleY(0);
        transition: transform .3s;
        background-image: linear-gradient(rgba(255,0,0,0), black);
        white-space: pre-wrap;
        width: 100%;
        position: absolute;
        top: 50%;
        left: 0px;
        transform: scaleY(1);
        height: 50%;
        text-align: end;
    }

    .title {
        font-weight: 800;
        margin-top: 10px;
        margin-left: 5px;
        margin-right: 5px;
        text-align: left;
        font-size: 14px !important;
        font-weight: bold;
        width: 95%;
        color: #F1F1F2;
        padding-left: 5px;
    }

    .footerinfo{
        font-weight: 400;
        margin-top: 10px;
        margin-left: 5px;
        margin-right: 5px;
        text-align: left;
        font-size: 12px !important;
        position: absolute;
        margin-bottom: 5px;
        bottom: 0;
        left: 5px;
        right: 5px;
        color: white;
    }

    div {
        width: 100%;
        margin-left: 0;
        display: block;
    }

    .myCol {
        padding-bottom: 10px;
        margin-bottom: 25px;
        padding-left: 0;
        padding-right: 0;
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

    @media only screen and (max-width: 400px) {

      .videoInfo {
          margin: auto;
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
                if(this.$route.params.id != null){
                    this.getRelated();
                } else if(this.terms == "" || this.terms == null){
                    this.getTrending();
                } else {
                    axios
                .post('/search', {terms: this.terms})
                .then((response => {
                    this.videos = response.data.videos;
                    this.loading = false;
                }));
                }
            },

            msToTime: function(s) {
            var ms = s % 1000;
            s = (s - ms) / 1000;
            var secs = s % 60;
            s = (s - secs) / 60;
            var mins = s % 60;
            var hrs = (s - mins) / 60;
            secs = String(secs).padEnd(2, "0");
            return mins + ':' + secs ;
            },

            createdAt: function(s) {
            var createdAt = s.substr(0, 10);
            return createdAt;
            },

            getTrending: function() {
                    axios
                .get('/fetchtrending')
                .then((response => {
                    this.videos = response.data.videos;
                    this.loading = false;
                }));

            },

            getRelated: function() {
                var id = this.$route.params.id;

                    axios
                .post('/fetchrelated', {id: id})
                .then((response => {
                    this.videos = response.data.videos;
                    this.loading = false;
                }));
            }

        }
    }
</script>