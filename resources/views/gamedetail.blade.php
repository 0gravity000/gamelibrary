@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="/game/{{ $serachgamename }}">一覧へ戻る</a>

            @foreach($videoitems as $item)
            <div>
            {!! $item->player->embedHtml !!}<br>
    
            <h2>{{ $item->snippet->title }}</h2>
            <h3>チャンネル：{{ $item->snippet->channelTitle }}</h3>
            <h3>チャンネルID：{{ $item->snippet->channelId }}</h3>
            {{ $item->snippet->description }}<br>
            <br>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
