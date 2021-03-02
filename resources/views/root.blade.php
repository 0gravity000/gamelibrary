@extends('layouts.app')

@section('content')
<div class="content">
    <div class="row">
        <!-- リクエスト超過時のメッセージ -->
        <h1><a href="/">{{ $message ?? '' }}</a></h1>
    <!-- サイドバー -->
    <aside col-3>
        <form method="POST" action="/game">
            @csrf
            <div>
                <label for="InputGameName1" class="form-label">ゲーム名</label>
                <input type="text" class="form-control" name="InputGameName1">
                <div class="form-text">ゲーム名を指定してください。</div>
            </div>
            <button type="submit" class="btn btn-primary">検索する</button>
        </form>
        <br>
        <nav>
            <ul>
                @foreach ($gametitlealiases as $gametitlealiase)
                <li>
                    {{ $gametitlealiase->title }}
                </li>
                @endforeach
            </ul>
        </nav>
    </aside>
    <div>
        <h1>ピックアップ！</h1>
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @for ($i = 0; $i < count($gameitems); $i++)
                @foreach($gameitems[$i] as $item)
                <a href="/game/{{ $titles[$i] }}/{{ $item->id->videoId }}">
                    <img src="{{ $item->snippet->thumbnails->medium->url }}" class="d-block w-100" alt="...">
                </a>
                @endforeach
                @endfor
            </div>
        </div>
    </div>
</div>
@endsection
