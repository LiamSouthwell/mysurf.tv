
<template>
    <div>
        <div v-for="playlist in playlists" id="carousel" data-options="mode: carousel; height: 210px;">
        <p id="header">{{playlist.displayname}}</p>
            <div class="scrolling-wrapper">
                <div v-for="video in playlist.playlist.videos" class="card">
                    <router-link :to="'/watch/'+video.id" >
                        <thumbnail  :title="video.name" :thumbnail="video.poster" :duration="video.duration" :created_at="video.created_at"> </thumbnail>
                    </router-link>
                    <div class="title">
                        <h4>{{video.name}}</h4>
                    </div>
                    <div class="videoInfo">
                        <div class="vidName"> {{video.name}} </div>
                    </div>
                </div>
            </div>
            <div class="scrolling-btns">
            <button id="leftBtn"><span class="fa fa-chevron-left"></span></button>
            <button id="rightBtn"><span class="fa fa-chevron-right"></span></button>
            </div>
        </div>  
    </div>
</template>
<script>
export default {

    data: function () {
        return {
          videos: [],
          playlists: []
        }
    },

    mounted: function () {
            axios
        .get('/searchPlaylists')
        .then((response => {
            this.playlists = response.data;
        }));
    }
}
</script>

<style scoped>

 .scrolling-wrapper {
  overflow-x: scroll;
  overflow-y: hidden;
  }

  .card {
    display: inline-block;
    position: relative;
    width: 350px;
  }

  .title {
    text-align: center;
    font-size: 14px;
    width: 100%;
    color: white;
    position: absolute;
    top: 10px;
    left: 15px;
    margin: auto;
    transform: scaleY(0);
    transition: transform .3s;
  }

  .title > h4 {
      height: 35px;
      font-size: 15px;
      text-align: center;
  }

  .card .title {
      white-space: pre-wrap;
      width: 350px;
      color: white;
      position: absolute;
      top: 10px;
      left: 5px;
      transform: scaleY(0);
      transition: transform .3s;
  }

    .card:hover .title {
    transform: scaleY(1);
    background-image: linear-gradient(black, rgba(255,0,0,0));
  }

    #header {
        font-weight: bold;
    }

    #carousel {
        position: relative;
        white-space: nowrap;
        padding: 5px;
        margin: 10px;
        height: 340px;
    }

    .scrolling-btns {
      position: relative;
  }

    #leftBtn {
        position: absolute;
        left: 5px;
        top: 60%;
    }

    #rightBtn {
        position: absolute;
        right: 5px;
        top: 60%;
    }

    .videoInfo {
        white-space: pre-wrap;
        width: 350px;
        height: 60px;
        outline: 1px solid black;
  }

    .vidName {
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