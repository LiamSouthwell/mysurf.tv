
<template>
	<div class="embed-responsive embed-responsive-16by9">
		<div id="#player-container" class="videoplayer"> </div>
		   <!--<video :data-video-id="5986584291001" 
		        data-account="2728142626001" 
		        data-player="BJrkAHssG" 
		        data-embed="default" 
		        data-application-id 
		        class="video-js videoplayer" 
		        controls 
		        id="player">
		    </video>-->


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
                this.videoID = this.$route.params.id;
            }
        },
        mounted() {	
        	brightcovePlayerLoader({
			  refNode: document.getElementById('#player-container'),
			  accountId: '2728142626001',
			  playerId: 'BJrkAHssG',
			  videoId: '5986584291001'
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

        	console.log	("VIDEO WATCH");
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