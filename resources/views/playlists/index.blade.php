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
                          <th scope="row">{{$playlist->id}}</th>
                          <td>{{$playlist->name}}</td>
                          <td>{{$playlist->playlistid}}</td>
                          <td>{{$playlist->order}}</td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
