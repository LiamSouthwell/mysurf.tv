@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
                <form method="POST" action="/playlists/store">
                  @csrf
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Name of Playlist">
                    <small  class="form-text text-muted">Users will see this name as a header.</small>
                  </div>
                  <div class="form-group">
                    <label for="playlistid">Playlist ID</label>
                    <input type="text" class="form-control" name="playlistid" id="playlistid" placeholder="ID of Playlist">
                    <small  class="form-text text-muted">Copy & Paste the ID provided by Brightcove. </small>
                  </div>
                  <div class="form-group">
                    <label for="order">Order No</label>
                    <input type="text" class="form-control" name="order" id="order" placeholder="Priority">
                    <small  class="form-text text-muted">The priority of the playlist when viewing the homepage. </small>
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>

        </div>
    </div>
</div>
@endsection