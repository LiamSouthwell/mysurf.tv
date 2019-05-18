
<template>
	<div>
		<div class="embed-responsive embed-responsive-16by9">
			<div id="#player-container" class="videoplayer"> </div>
		</div>
		<div id="vidInfo">
			<h2>{{this.title}}</h2>
		</div>
		<div id="autoplay">
			<span>Autoplay next video</span>
			<label class="switch">
				<input type="checkbox">
				<span class="slider round"></span>
			</label>
			<div id="toggleLabels">
			<label id="offOn">Off/On</label>
		</div>
		</div>
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
            	nextvideo: [],
            	autoplay: true,
            	title: ""
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

				  myPlayer.on('loadedmetadata',()=>{
				  	this.title = myPlayer.mediainfo.name;
				    myPlayer.play();
				  });

				  myPlayer.on('ended', ()=>{ 
				  	if(this.autoplay)
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
	                this.nextvideo = response.data.videos[1];
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

#vidInfo {
	margin-top: 15px;
	text-align: center;
}

#autoplay {
	height: 50px;
	width: 100%;
	position: relative;
	text-align: right;
	right: 0;
	margin-right: 5px;
}

span {
	position: absolute;
	right: 68px;
	margin-top: 5px;
}

#toggleLabels {
	text-align: right;
	right: 5px;
}

label {
	position: absolute;
	right: 12px;
}

#offOn {
	position: relative;
	top: 32px;
}

.switch {
  position: absolute;
  width: 60px;
  height: 34px;
	right: 5px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

</style>
<style>
.video-js.vjs-quality-menu{
	width: 100%;
	height: 100%;
}
	</style>