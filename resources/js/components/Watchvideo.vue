
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
            	videoID: 0,
            	nextvideo: []
            }
        },
        watch:{
            $route (to, from){
            	brightcovePlayerLoader.reset();
            	this.playPlayer();
                this.videoID = this.$route.params.id;
            }
        },
        mounted() {	
        	this.playPlayer();
        	this.videoID = this.$route.params.id;
        },
        methods:{
        	playPlayer: function(){

	        	brightcovePlayerLoader({
				  refNode: document.getElementById('#player-container'),
				  accountId: '2728142626001',
				  playerId: 'BJrkAHssG',
				  videoId: this.$route.params.id
				})

				.then((success)=>{

				  var myPlayer = success.ref;
				  myPlayer.on('loadedmetadata',function(){
				    myPlayer.play();
				  });

				  myPlayer.on('ended', ()=>{ 
				  	this.playRelated();
				  });


				})

				.catch(function(error) {
					console.log("ERROR");
					console.log(error);
				// Player creation failed!
				});


        	},

        	playRelated: function() {
        		var id = this.$route.params.id;
				  	axios
	            .post('/fetchrelated', {id: this.$route.params.id})
	            .then((response => {
	                this.nextvideo = response.data.videos[0];
	                console.log(this.nextvideo.id);
	                this.$router.push({ path: '/watch/' + this.nextvideo.id })
	            }));
        	}
        }

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