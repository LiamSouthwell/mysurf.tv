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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
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
        <div class="container">
            <div id="app">
                <navbar></navbar>
                <div class="content">
                    <div style="position: relative; display: block; max-width: 960px;">
                        <div style="padding-top: 2.25%; height: 200px;">
                        <video data-video-id="6023123229001" 
                        data-account="6022296345001" 
                        data-player="ExFAwNTvB" 
                        data-embed="default" 
                        data-application-id 
                        class="video-js" 
                        controls 
                        style="position: absolute; inset: 0px; width: 100%; height: 100%;"
                        id="player">
                        </video>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="./js/app.js"></script>
    <script src="//players.brightcove.net/6022296345001/ExFAwNTvB_default/index.min.js"></script>
    <script>
        videojs.getPlayer('player').on('loadedmetadata', function() {
            var myPlayer = this;
            myPlayer.muted(true);
            myPlayer.play();

        });

        async function asyncVideo() {
            console.log('Requesting video...');
            //const response = await fetch('https://edge.api.brightcove.com/playback/v1/accounts/6022296345001');

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                   // Typical action to be performed when the document is ready:
                   //document.getElementById("demo").innerHTML = xhttp.responseText;
                   
                }
            };
            xhttp.open("GET", "https://edge.api.brightcove.com/playback/v1/accounts/6022296345001", true);
            xhttp.send();

            //const response = await fetch('https://edge.api.brightcove.com/playback/v1/accounts/6022296345001');
            const myJson = await response.json(); //extract JSON from the http response
            // do something with myJson
            console.log(myJson);

            console.log(result);
            // expected output: 'resolved'
        }
        asyncVideo();
    </script>
</html>
