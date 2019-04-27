
<template>
    <div id="carousel" data-options="mode: carousel; height: 210px;">
    <p id="header">{{this.name}}</p>
        <button id="leftBtn"><span class="fa fa-chevron-left"></span></button>
        <div class="scrolling-wrapper">
            <div v-for="video in videos" class="card">
                <thumbnail  :title="video.name" :thumbnail="video.thumbnail" :duration="video.duration" :created_at="video.created_at"> </thumbnail>
            </div>
        </div>
        <button id="rightBtn"><span class="fa fa-chevron-right"></span></button>
    </div>  
</template>
<script>
export default {
    props: ['playlistid', 'name'],

    data: function () {
        return {
          videos: []
        }
    },

    mounted: function () {
        console.log("mounted");
        console.log(this.playlistid);
            axios
        .post('/searchPlaylist', [this.playlistid])
        .then((response => {
            this.videos = response.data.videos;
            console.log(this.videos);
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