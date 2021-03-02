@extends('layouts.app')

@section('content')
<div class="content">
    <div class="row justify-content-center">
        <h1>ピックアップ！</h1>
    </div>
    <div class="row justify-content-center">
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

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="/game">
                @csrf
                <div class="mb-3">
                    <label for="InputGameName1" class="form-label">ゲーム名</label>
                    <input type="text" class="form-control" name="InputGameName1">
                    <div class="form-text">ゲーム名を指定してください。</div>
                </div>
                <button type="submit" class="btn btn-primary">検索する</button>
            </form>
        </div>
    </div>
</div>
@endsection
