
<template>
    <div>
        <br style="clear: both">
        <h2  id="header" v-if="$route.params.id != null" >Related</h2>
        <h2  id="header" v-else-if="$route.path == '/trending'">Trending</h2>
        <h2  id="header" v-else-if="$route.path == '/latest'">Latest</h2>
        <div v-if="this.loading">
            <loader> </loader>
        </div>
        <div v-else class="col-lg-3 col-md-4 col-sm-6 videoList" v-for="(video, index) in videos">
            <div class="row vids">
                <div class="col myCol">
                    <div class="video embed-responsive-item">
                        <router-link :to="'/watch/'+video.id" :id="'link'+index" style="width: inherit; height: inherit">
                          <figure class="sixteen-nine-img"> 
                            <img style="width: inherit; height: inherit; " :src="video.poster" :id="'thumbnail'+index"/>
                              <div class="overlaywrapper">
                                <div class="overlay">
                                    <div class="overlaytitle">
                                        {{video.name}}
                                    </div>
                                    <div class="overlaydescription">
                                        {{video.description}}
                                    </div>
                                </div>
                              </div>
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

    img{
        height: inherit;
        margin: auto;
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
        background-image: linear-gradient(#2d3f51, rgba(255,0,0,0));
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
        background-image: linear-gradient(rgba(255,0,0,0), #2d3f51);
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
    .overlaywrapper {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      background-color: rgba(255,255,255,0.2);
      overflow: hidden;
      width: 100%;
      height: 0;
      transition: .5s ease;
      z-index: 999;
      padding-left: 10px;
      margin-right: 10px;
    }

    .video:hover .overlaywrapper {
      height: 100%;
    }

    .overlay {
      color: white;
      font-size: 20px;
      position: absolute;
      top: 50%;
      left: 50%;
      text-align: left !important;
      -webkit-transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
      transform: translate(-50%, -50%);
      text-align: center;
    }

    .overlaytitle{
        font-size: 24px;
        margin: 10px;
        padding-right: 10px;
    }


    .overlaydescription{
        font-size: 18px;
        margin: 10px;
        padding-right: 10px;
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
            document.body.style.backgroundColor = "#e6e6e6";


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
                } else if(this.$route.path == "/trending"){
                    this.getTrending();
                } else if (this.$route.path == "/recent"){
                    this.getRecent();
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
            getRecent: function() {
                    axios
                .get('/fetchrecent')
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