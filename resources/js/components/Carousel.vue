
<template>
    <div>
      <div v-if="videos.length != 0">

        <p id="header">{{this.title}}</p>
        <div id="carousel" data-options="mode: carousel; height: 210px;">      
            <div class="scrolling-wrapper" :id="'scroller'+this.title">
                <div v-for="video in videos" class="card">
                    <router-link :to="'/watch/'+video.id" >
                        <thumbnail  :title="video.name" :thumbnail="video.thumbnail" :duration="video.duration" :created_at="video.created_at"> </thumbnail>
                    
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
              <p id="leftBtn" v-on:click="scrollLeft(title)"><span class="fa fa-chevron-left" style="color: white"></span></p>
              <p id="rightBtn" v-on:click="scrollRight(title)"><span class="fa fa-chevron-right" style="color: white"></span></p>
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
        document.getElementById('scroller'+id).scrollLeft += 365;
      },
      scrollLeft: function(id){
        document.getElementById('scroller'+id).scrollLeft -= 365;
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
    position: relative;
    width: 365px;
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
    margin-left: 7.5px;
    margin-right: 7.5px;
    text-align: left;
    font-size: 14px !important;
    width: 90%;
    color: #F1F1F2;
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
    }

    #carousel {
        position: relative;
        white-space: nowrap;
        padding: 5px;
        overflow:hidden;
    }

    .scrolling-btns {
      position: absolute;
      bottom: 40%;
      left: 0;
      width: 100%;
      height: 10%;
      z-index: 10;
  }

    #leftBtn {
        position: absolute;
        left: 15px;
        cursor: pointer;
        background-color: rgba(0,0,0,0.5);
        width: 25px;
        height: 25px;
        text-align: center;
        border-radius: 50%;
        padding-right: 2px;
    }

    #rightBtn {
        position: absolute;
        right: 15px;
        cursor: pointer;
        background-color: rgba(0,0,0,0.5);
        width: 25px;
        height: 25px;
        text-align: center;
        border-radius: 50%;
        padding-left: 2px;
    }


    .videoInfo {
        white-space: pre-wrap;
        width: 330px;
        height: 50px;
        outline: 2px solid black;
        background-color: #f4f4f4;
        margin-left: 10px;
        margin-right: 10px;
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

    div {
        width: 100%;
        margin-left: 0;
        display: block;
    }

</style>