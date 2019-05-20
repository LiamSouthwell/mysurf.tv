
<template>
	<div style="max-height:875px;">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> 
		<div class="embed-responsive embed-responsive-16by9">
			<div id="#player-container" class="videoplayer embed-responsive-item" > </div>
		</div>
		<div id="titleBtns">
			<div id="vidInfo">
				<h2>{{this.title}}</h2>
			</div>
			<div id="vidBtns" > 
				<div id="addBtn" style="z-index: 2;" @click="addToPlaylist()">
					<i class="material-icons" >
						playlist_add
					</i>
					<label id="addPlaylist">Add to playlist</label>
				</div>
				<div id="autoplay">
					<label id="apLabel">Autoplay next video</label>
					<label class="switch">
						<input type="checkbox" v-model="autoplay">
						<span class="slider round"></span>
					</label>
				</div>
			</div>
		</div>

<div class="modal fade" id="addToPlaylistModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add to Playlist</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div v-if="loading">

      	</div>
      	<div v-else>
	        <div v-if="this.playlists.length == 0"> 
	        	There are no playlists to display.
	        	Visit <router-link data-dismiss="modal" to="/userplaylists"> here </router-link> to add one. 
	        </div>
	        <div v-else >
		        	<div class="list-group">
						<button v-for="playlist in this.playlists" type="button" @click="addVideoToPlaylist(playlist.id)" class="list-group-item list-group-item-action">{{playlist.name}}</button>	
		        	</div>
	        </div>
    	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
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
            	autoplay: false,
            	title: "",
            	user: ["none"],
            	playlists: [],
            	loading: true
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
					document.getElementById("header").style.color = "#212529";
          document.getElementById("vidBtns").style.color = "#212529";
				
			axios
	            .get('/getUser')
	            .then((response => {
	            	this.user = response.data;
	            }));

        },
        methods:{
        	addToPlaylist: function(){
        		if(this.user[0] != ["none"]){
        			console.log(this.user);
        			this.getPlaylists();
        		 	$('#addToPlaylistModal').modal('show');
        		 }
        		else
        			window.location.href = "/register";
        	},
        	addVideoToPlaylist: function($id){
        			axios
	            .post('/addvideotoplaylist', {"videoid": this.videoID, "playlistid": $id})
	            .then((response => {
						alert("Saved your video to the playlist.");
	            }));
        	},
        	getPlaylists: function(){
        			axios
	            .get('/fetchuserplaylists')
	            .then((response => {
	                	this.playlists = response.data;
	                	this.loading = false;

	            }));
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

.embed-responsive{
	max-height: 675px;
}

.videoplayer{
    position: absolute;
    top: 0px;
    right: 0px;
    bottom: 0px;
    left: 0px;
    width: 100% !important;
    height: 100% !important;
		max-height: 675px;
}

#titleBtns {
	height: 120px;
	margin-top: 15px;
}

#vidInfo {
	width: 80%;
	margin-top: 15px;
	text-align: center;
	margin-bottom: 15px;
	margin-left: auto;
	margin-right: auto;
}

#vidInfo > h2 {
	font-size: 25px;
}


#autoplay {
	height: 45px;
	width: 56%;
	max-width: 230px;
	min-width: 215px;
	position: relative;
	text-align: right;
	margin-left: auto;
	right: 0;
	z-index: 1;
	top: -45px;
	color: black;
	background-color: #dedbdb;
	border: 1px solid #bfbfbf;
	border-radius: 25px;
}

#addBtn {
	color: black;
	width: 40%;
	height: 45px;
	background-color: #dedbdb;
	max-width: 150px;
	border: 1px solid #bfbfbf;
	border-radius: 25px;
}

#vidBtns {
	z-index: -1;
}

span {
	position: absolute;
	right: 78px;
	top: 10px;
}

#addPlaylist {
	position: absolute;
	left: 35px;
	float: left;
	height: 34px;
	width: 110px;
	color: black;
	padding-top: 10px;
}

.material-icons {
	position: absolute;
	left: 5px;
	float: left;
	padding-top: 10px;
}

#toggleLabels, {
	text-align: right;
	right: 5px;
}

#apLabel {
	position: absolute;
	right: 60px;
	top: 10px;
	width: 141px;
}

.switch {
  position: absolute;
  width: 55px;
  height: 34px;
	right: 2px;
	top: 5px;
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

@media only screen and (min-wdith: 470px) {
	#titleBtns {
		height: 100px;
	}
}

@media only screen and (min-width: 380px) {
	#autoplay {
		position: relative;
	}
	#titleBtns {
		height: 110px;
	}
}


</style>
<style>
@media only screen and (min-width: 1170px) {
	.video-js.vjs-quality-menu{
	width: 100%;
	height: 80%;
	max-height: 675px;
}
	.titleBtns{
		padding-top: 15px;
	}
}

.video-js.vjs-quality-menu{
	width: 100%;
	height: 100%;
}

@media only screen and (min-width: 1300px) {
	#vidInfo {
		position: relative;
		top: -20px;
	}
	#titleBtns{
		position: relative;
		height: 90px;
		padding-top: 15px;
	}
}

</style>