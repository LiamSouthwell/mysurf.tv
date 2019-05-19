<template>
	<div class="container">
		<div v-if="loading" class="text-center">
			<loader></loader>
		</div>
		
		<div v-else>
			<div v-for="playlist in playlistsCarousel">
				<carousel  :title="playlist.title" :videos="playlist.videos"> </carousel>
			</div>
		</div>


		</br>
		<div class="text-center">
			<button type="button" class="btn btn-primary col-md-4" data-toggle="modal" data-target="#addPlaylistModal">New Playlist</button>

			<!-- Modal -->
			<div class="modal fade" id="addPlaylistModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Add a Playlist</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			        <form>
					  <div class="form-group">
					    <label for="name">Name of Playlist</label>
					    <input v-model="newPlaylistName" type="text" class="form-control" id="name"  placeholder="Enter name">

					  </div>

					  <button @click="addPlaylist" class="btn btn-primary">Submit</button>
					</form>
			      </div>
			    </div>
			  </div>
			</div>
		</div>
	</div>


</template>

<script>

	export default {
        
    data () {
        return {
        	playlists: [],
        	playlistsCarousel: [],
        	newPlaylistName: "",
        	loading: true
    	}
    },
    mounted() {
    	this.getPlaylists();
			document.body.style.backgroundColor = "#e6e6e6";
      document.body.style.color = "#212529";
    },
    methods:{
		getPlaylists: function(){
    			axios
            .get('/fetchuserplaylists')
            .then((response => {
                	this.playlists = response.data;
                	this.getVideosForPlaylists();
                	

            }));
    	},
    	addPlaylist: function(){
    		    axios
            .post('/adduserplaylist', {name: this.newPlaylistName})
            .then((response => {
            	//there are no playlists
                if(response.data = []){		

                } else { //there are some playlists 
                	this.playlists = resonse.data;
                }
            }));
    	},
    	getVideosForPlaylists: function(){
    		this.playlists.forEach((playlist) => {
    			var name = playlist.name;
	    			axios
	    		.get('/fetchplaylistvideos/' + playlist.id)
	    		.then((response=>{
	    			var videos = response.data;
	    			var playlist = {'title': name, 'videos': videos};
	    			this.playlistsCarousel.push(playlist);

    		
	    		}));
    		})
			this.loading = false;	
    	},
    }
}


</script>