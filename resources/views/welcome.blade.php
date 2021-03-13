<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>GameLibrary</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

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
                height: 10vh;
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
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    </head>
    <body>
        <div class="flex-center position-ref full-height">
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
            @endif
        </div>

        <div class="container">
            <div class="content">
            <div class="row">
                <div class="title m-b-md">
                    <a href="/root/1">GameLibrary</a>
                </div>
            </div>
            <div class="row">
                <div class="m-b-md">
                    <a href="/root/1">人気ゲームの動画をチェック！！</a>
                </div>
            </div>
            </div>
            <div class="row">
                <!-- リクエスト超過時のメッセージ -->
                <h1>{{ $message ?? '' }}</h1>
            </div>

            <div class="row">
                <div class="col-md-8">
                <h1>ピックアップ！</h1>
                    @foreach ($searchlists as $searchlist)
                    <div class="card" style="width: 28rem;">
                        <h5 class="card-header">
                            {!! html_entity_decode($searchlist->gametitle_aliase->title) !!}
                        </h5>
                        <a href="/game/{{ $searchlist->gametitle_aliase->title }}/{{ $searchlist->videoid }}">
                            <img src="{{ $searchlist->thumbnails_mediumurl }}" class="d-block w-100" alt="...">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">{!! html_entity_decode($searchlist->title) !!}</h5>
                            <p class="card-text">{!! html_entity_decode($searchlist->description) !!}</p>
                        </div>
                   </div>
                    @endforeach
                </div>
            </div>
        
        </div>
        </div>
    </body>
</html>
