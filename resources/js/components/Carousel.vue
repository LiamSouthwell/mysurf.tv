
<template>
    <div>
      <div v-if="videos.length != 0">
        
          <p id="header">{{this.title}}</p>
        <div id="carousel" data-options="mode: carousel; height: 210px;">      
            <div class="scrolling-wrapper" :id="'scroller'+this.title">
                <div v-for="video in videos" class="card">
                    <router-link :to="'/watch/'+video.id">

  

                    <thumbnail  :title="video.name" :thumbnail="video.poster" :duration="video.duration" :created_at="video.created_at" :description="video.description"> </thumbnail>
                  
                   
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
            <div class="scrolling-btns" >
              <a class="carousel-control-prev" v-on:click="scrollLeft(title)" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>

              <a class="carousel-control-next" v-on:click="scrollRight(title)" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
        </div> 
      </div>
      <div v-else>
        <p id="header">{{this.title}}</p>
        No videos to display.
      </div>

    </div>
</template>
<script>
export default {

    data: function () {
        return {

        }
    },
    props: ['title', 'videos'],
    mounted: function () {

    },
    methods: {
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
      scrollRight: function(id){
        var width = document.getElementsByClassName("card")[0].offsetWidth;

        document.getElementById('scroller'+id).scrollLeft += width;
      },
      scrollLeft: function(id){
        var width = document.getElementsByClassName("card")[0].offsetWidth;
        document.getElementById('scroller'+id).scrollLeft -= width;
      }
    }
}
</script>

<style scoped>
  h2 {
      text-align: center;
  }


 .scrolling-wrapper {
    overflow-x: hidden;
    overflow-y: hidden;
    scroll-behavior: smooth;
  }

  .card {
    display: inline-block;
    max-width: 640px;

    max-height: 370px;
    background: #dddddd;
    border: 2px solid #F1F1F2; 
  }
  .titlewrap{
    position: absolute;
    margin: auto;
    transform: scaleY(0);
    transition: transform .3s;
    background-image: linear-gradient(#2d3f51, rgba(255,0,0,0));
    white-space: pre-wrap;
    width: 101%;
    position: absolute;
    top: 0px;
    left: 0px;
    transform: scaleY(1);
    height: 30%;
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
    width: 101%;
    position: absolute;
    top: 70%;
    left: 0px;
    transform: scaleY(1);
    height: 30%;
    text-align: end;
  }
  .carousel-control-next-icon, .carousel-control-prev-icon{
    height: 40px;
    width: 40px;
  }
  .title {
    font-weight: 700;
    margin-top: 10px;
    margin-left: 7.5px;
    margin-right: 7.5px;
    text-align: left;
    font-size: 17px !important;
    width: 90%;
    color: #F1F1F2;

  text-decoration: underline;
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

    #header {
        font-weight: bold;
        border-bottom: 1px solid grey;
        padding-left: 15px;
        font-size: 24px;
        padding-top: 15px;
    }

    #carousel {
        position: relative;
        white-space: nowrap;
        padding: 5px;
        overflow:hidden;
    }

    .scrolling-btns {
      left: 0;
      width: 100%;
      z-index: 10;
  }

  .carousel-control-next{
    text-align: right;
  }
  .carousel-control-prev{
    text-align: left; 
  }


    .vidName {
      color: black;
      height: 50px;
      text-align: center;
      font-size: 14px;
      font-weight: bold;
      margin-left: 5px;
      margin-right: 5px;
      overflow: hidden;
      word-wrap: break-word;
    }

@media only screen and (max-width: 1100px) {
  .card {
    max-width: 365px;
    max-height: 205px;
  }

  .footerwrap{
    top: 72%;
  }
}

</style>