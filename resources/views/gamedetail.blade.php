@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="/game">
                @csrf
                <div class="mb-3">
                    <input type="hidden" name="InputGameName1" value={{ $serachgamename }}>
                </div>
                <button type="submit" class="btn btn-primary">一覧へ戻る</button>
            </form>

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
