@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="/root">トップ画面へ戻る</a>
            <hr>
            <h1>{!! html_entity_decode($serachgamename) !!}&nbsp;の動画</h1><br>
            @foreach($searchlists as $searchlist)
            <div class="media">
                <a href="/game/{{ $serachgamename }}/{{ $searchlist->videoid }}">
                    <img class="mr-3" src="{{ $searchlist->thumbnails_defaulturl }}" alt="Generic placeholder image">
                </a>
                <div class="media-body">
                    {!! html_entity_decode($searchlist->title) !!}
                    <!-- {{ $searchlist->title }} -->
                </div>
            </div>
            <br>
            @endforeach
        </div>
    </div>
</div>
@endsection
