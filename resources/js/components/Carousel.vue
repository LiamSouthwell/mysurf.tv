
<template>
    <div>
        <div v-for="playlist in playlists" id="carousel" data-options="mode: carousel; height: 210px;">
        <p id="header">{{playlist.displayname}}</p>
            <button id="leftBtn"><span class="fa fa-chevron-left"></span></button>
            <div class="scrolling-wrapper">
                <div v-for="video in playlist.playlist.videos" class="card">
                    <router-link :to="'/watch/'+video.id" >
                        <thumbnail  :title="video.name" :thumbnail="video.poster" :duration="video.duration" :created_at="video.created_at"> </thumbnail>
                    </router-link>
                    <div class="title">
                        <h4>{{video.name}}</h4>
                    </div>
                </div>
            </div>
            <button id="rightBtn"><span class="fa fa-chevron-right"></span></button>
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
  white-space: nowrap;
  }

  .card {
    display: inline-block;
    position: relative;
    width: 300px;
    word-break: break-all;
  }

  h4 {
    overflow: inherit;
  }

  .title {
      width: 350px;
  }

  .title > h4 {
      height: 35px;
      font-size: 14px;
      text-align: center;
  }

  .card .title {
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
    background: rgba(255, 0, 0, 0.6);
  }

  div {
      display: block;
  }

    #header {
        font-weight: bold;
    }

    #carousel {
        position: relative;
        overflow: auto;
        white-space: nowrap;
        padding: 5px;
        margin: 10px;
    }

    #leftBtn, rightBtn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
    }

</style>