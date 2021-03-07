@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="/root">トップ画面へ戻る</a>
            <hr>
            <h1>{!! html_entity_decode($serachgamename) !!}&nbsp;の動画</h1><br>
            @foreach($gameitems as $item)
            <div class="media">
                <a href="/game/{{ $serachgamename }}/{{ $item->id->videoId }}">
                    <img class="mr-3" src="{{ $item->snippet->thumbnails->default->url }}" alt="Generic placeholder image">
                </a>
                <div class="media-body">
                    {!! html_entity_decode($item->snippet->title) !!}
                    <!-- {{ $item->snippet->title }} -->
                </div>
            </div>
            <br>
            @endforeach
        </div>
    </div>
</div>
@endsection
