@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Brightcove ID</th>
                      <th scope="col">Order</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($playlists as $playlist)
                            <tr>
                              <th scope="row"><a href="/playlists/edit/{{$playlist->id}}">{{$playlist->id}}</a></th>
                              <td>{{$playlist->name}}</td>
                              <td>{{$playlist->playlistid}}</td>
                              <td>{{$playlist->order}}</td>
                              <td>
                                <button type="button" class="close" aria-label="Close" data-toggle="modal" data-target="#deleteModal{{$playlist->id}}">
                                  <span aria-hidden="true" style="color:red">&times;</span>
                                </button></td>
                            </tr>
<!-- Modal for confirming delete -->
<div class="modal fade" id="deleteModal{{$playlist->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Deleting this playlist cannot be undone. <br>
        <strong>Note:</strong> This will only delete the playlist from the mysurf.tv platform & not Brightcove.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="/playlists/delete/{{$playlist->id}}" class="btn btn-danger">DELETE</a>
      </div>
    </div>
  </div>
</div>




                    @endforeach
                  </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
