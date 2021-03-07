@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="/game/{{ $serachgamename }}">一覧へ戻る</a>
            <hr>
            <h1>{!! html_entity_decode($serachgamename) !!}&nbsp;の動画</h1><br>
            @foreach($videoitems as $item)
            <div>
            {!! $item->player->embedHtml !!}<br>
    
            <h2>{{ $item->snippet->title }}</h2>
            <h3>チャンネル：{!! html_entity_decode($item->snippet->channelTitle) !!}</h3>
            <h3>チャンネルID：{{ $item->snippet->channelId }}</h3>
            {!! html_entity_decode($item->snippet->description) !!}<br>
            <br>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
