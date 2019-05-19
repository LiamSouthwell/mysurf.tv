<template>
	<div class="container">
		<div v-if="loading" class="text-center">
			There are no playlists to dispay.

		</div>
		
		<div v-else>
			<div v-for="playlist in playlists">
				{{playlist.name}}
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
        	newPlaylistName: "",
        	loading: true
    	}
    },
    mounted() {
    	this.getPlaylists();
    },
    methods:{
		getPlaylists: function(){
    			axios
            .get('/fetchuserplaylists')
            .then((response => {

                	this.playlists = response.data;
                	this.loading = false;
    				console.log(response.data);

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
    	}
    }
}


</script>