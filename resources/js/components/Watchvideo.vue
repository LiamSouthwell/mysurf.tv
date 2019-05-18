
<template>
	<div>
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> 
		<div class="embed-responsive embed-responsive-16by9">
			<div id="#player-container" class="videoplayer"> </div>
		</div>
		<div id="vidInfo">
			<h2>{{this.title}}</h2>
		</div>
		<div id="vidBtns">
			<div>
				<i class="material-icons" v-on:click="addToPlaylist">
					playlist_add
				</i>
				<label id="addPlaylist">Add to playlist</label>
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
            	title: "",
            	user: ["none"],
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
					document.getElementById("header").style.color = "#F1F1F2";
          document.getElementById("vidBtns").style.color = "#212529";
					
			axios
	            .get('/getUser')
	            .then((response => {
	            	this.user = response.data;
	            	console.log(response.data);
	            }));

        },
        methods:{
        	addToPlaylist: function(){
        		if(this.user[0] != ["none"])
        			console.log(this.user);
        		else
        			window.location.href = "/register";


        	},

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
	width: 80%;
	margin-top: 15px;
	text-align: center;
	margin-bottom: 15px;
	margin-left: auto;
	margin-right: auto;
}

#autoplay {
	height: 75px;
	width: 100%;
	position: relative;
	text-align: right;
	right: 0;
	margin-right: 5px;
	top: -10px;
}

#vidBtns {
	background-color: #F1F1F1;
	padding-top: 15px
}

span {
	position: absolute;
	right: 68px;
	top: 10px;
}

#addPlaylist {
	position: absolute;
	left: 35px;
	float: left;
}

.material-icons {
	position: absolute;
	left: 10px;
	float: left;
}

#toggleLabels, {
	text-align: right;
	right: 5px;
}

label {
	position: absolute;
	right: 12px;
}

#offOn {
	position: relative;
	top: 40px;
}

.switch {
  position: absolute;
  width: 60px;
  height: 34px;
	right: 5px;
	top: 8px;
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