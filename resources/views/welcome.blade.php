<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>window.Laravel = { csrfToken: '{{ csrf_token() }}'}
        </script>

        <title>mySURF.TV</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="./sass/app.scss" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    </head>
    <body>
        <!-- <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif -->

            <div id="app" style="background-color: #dddddd">
                <!--<router-link to="/search">/link1</router-link>
                <router-link to="/view">/link1</router-link>-->
                <navbar></navbar>
                <router-view name="default"></router-view>
                <br>
                <h2 id="header" style="text-align: center; font-weight: bold; padding-bottom: 15px;">Trending</h2>
                <router-view name="viewport"></router-view>
                <!--
                @foreach($playlists as $playlist)
                    <carousel playlistid="{{$playlist->playlistid}}" name="{{$playlist->name}}"></carousel>
                @endforeach
                -->
                <footerbar></footerbar>
            </div>

    </body>
    <script src="./js/app.js"></script>
    <script src="//players.brightcove.net/2728142626001/BJrkAHssG_default/index.min.js"></script>
    <script>
        /*videojs.getPlayer('player').on('loadedmetadata', function() {
            var myPlayer = this;
            myPlayer.muted(true);
            myPlayer.play();
        });*/
    </script>
</html>
