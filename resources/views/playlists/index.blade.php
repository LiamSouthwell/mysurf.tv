@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

            <div class="card col-md-12">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Brightcove ID</th>
                      <th scope="col">Order</th>
                      <th> </th>
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
                    @endforeach
                  </tbody>
                </table>
            </div>
            <a href="/playlists/create" class="btn btn-success col-md-12"  style="margin-top: 10px;">New Playlist</a>

    </div>
</div>
@endsection
