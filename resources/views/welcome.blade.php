<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script data-ad-client="ca-pub-6897468555074184" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="/css/gamelibrary.css" rel="stylesheet">

    </head>
    <body>
        <!-- ナビバー -->
        <ul class="nav justify-content-end">
            <li class="nav-item">
                @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/home') }}">Home</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                        @endif
                    @endauth
                </div>
            @endif
            </li>
        </ul>

        <div class="container">
            <div class="row">
                <div class="title mx-auto">
                    <a href="/root/1">GameLibrary</a>
                </div>
            </div>
            <div class="row">
                <div class="mx-auto pb-4">
                    <a href="/root/1">人気ゲームの動画をチェック！！</a>
                </div>
            </div>

            <div class="row">
                <!-- リクエスト超過時のメッセージ -->
                <h1>{{ $message ?? '' }}</h1>
            </div>

            <div class="row">
                <div class="mx-auto">
                    <h2>ピックアップ！</h2>
                </div>
            </div>
            <div class="row">
                @foreach ($searchlists as $searchlist)
                <div class="col-md-4">
                    <div class="card">
                        <h5 class="card-header">
                            {!! html_entity_decode($searchlist->gametitle_aliase->title) !!}
                        </h5>
                        <a href="/game/1/{{ $searchlist->gametitle_aliase->title }}/{{ $searchlist->videoid }}">
                            <img src="{{ $searchlist->thumbnails_mediumurl }}" class="d-block w-100" alt="...">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">{!! html_entity_decode($searchlist->title) !!}</h5>
                            <p class="card-text">{!! html_entity_decode($searchlist->description) !!}</p>
                        </div>
                   </div>
                </div>
                @endforeach
            </div>
        </div>
    </body>
</html>
