
<template>

	<div class="embed-responsive embed-responsive-16by9">
		<div id="#player-container" class="videoplayer"> </div>
	</div>

</template>

<style scoped>
    
</style>

<script>
import brightcovePlayerLoader from '@brightcove/player-loader';
export default {
        

        data () {
            return {
            	videoID: 0
            }
        },
        watch:{
            $route (to, from){
            	brightcovePlayerLoader.reset();
                this.videoID = this.$route.params.id;
            brightcovePlayerLoader({
			  refNode: document.getElementById('#player-container'),
			  accountId: '2728142626001',
			  playerId: 'BJrkAHssG',
			  videoId: this.$route.params.id
			})
			  .then(function(success) {
			      var myPlayer = success.ref;
			      console.log('success', success);
			      myPlayer.on('loadedmetadata',function(){
			        myPlayer.muted(true);
			        myPlayer.play();
			      });
			  })
			  .catch(function(error) {
			  	console.log("ERROR");
			  	console.log(error);
			    // Player creation failed!
			  });


            }
        },
        mounted() {	

            brightcovePlayerLoader({
			  refNode: document.getElementById('#player-container'),
			  accountId: '2728142626001',
			  playerId: 'BJrkAHssG',
			  videoId: this.$route.params.id
			})
			  .then(function(success) {
			      var myPlayer = success.ref;
			      console.log('success', success);
			      myPlayer.on('loadedmetadata',function(){
			        myPlayer.muted(true);
			        myPlayer.play();
			      });
			  })
			  .catch(function(error) {
			  	console.log("ERROR");
			  	console.log(error);
			    // Player creation failed!
			  });
        	this.videoID = this.$route.params.id;
        },
        methods:{}

}



</script>

<style scoped>

.videoplayer{
    position: absolute;
    top: 0px;
    right: 0px;
    bottom: 0px;
    left: 0px;
    width: 100% !important;
    height: 100% !important;

}

</style>
<style>
.video-js.vjs-quality-menu{
	width: 100%;
	height: 100%;
}
	</style>