<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Playlist;


class Playlistcontroller extends Controller
{
    

    public function index(){
    	$playlists = Playlist::all();
    	return view('playlists.index')->with('playlists', $playlists);
    }

    public function create(){
    	return view('playlists.create');
    }

    public function store(Request $request){
    	$playlist = new Playlist();
    	$playlist->name = $request->name;
    	$playlist->playlistid = $request->playlistid;
    	$playlist->order=4;
    	$playlist->save();
    	return redirect('/playlists');
    }

    public function edit($id){
    	$playlist = Playlist::find($id);
    	return view('playlists.edit')->with('playlist', $playlist);
    }

    public function update($id, Request $request){
    	$playlist = Playlist::find($id);
    	$playlist->name = $request->name;
    	$playlist->playlistid = $request->playlistid;
    	$playlist->order=$request->order;
    	$playlist->save();
    	return redirect('/playlists');
    }    

    public function delete($id){
    	$playlist = Playlist::find($id);
    	$playlist->delete();
    	return redirect('/playlists');
    }
}
