
<template>
	<div class="embed-responsive embed-responsive-16by9">
		<div id="#theDiv"> </div>
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

export default {
        
        data () {
            return {
            	videoID: 0
            }
        },
        watch:{
            $route (to, from){
            	console.log(this.$route.params);
                this.videoID = this.$route.params.id;
            }
        },
        mounted() {	
        	this.$brightcovePlayerLoader();

        	console.log("VIDEO WATCH");
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