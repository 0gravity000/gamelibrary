@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="/game/{{$typeid}}/{{ $serachgamename }}">一覧へ戻る</a>
            <hr>
            <h2>{!! html_entity_decode($serachgamename) !!}&nbsp;の動画</h2>
            <a href="https://www.amazon.co.jp/gp/search?ie=UTF8&tag=0gravity000-22&linkCode=ur2&linkId=70ba0fbd7cd86ef756b12ea141133af2&camp=247&creative=1211&index=videogames&keywords={{$serachgamename}}" target="_blank" rel="noopener noreferrer">
                Amazonで{{$serachgamename}}をチェック
            </a>
            <hr>
            @foreach($videoitems as $item)
            <div class="card mb-8">
                {!! $item->player->embedHtml !!}
                <div class="card-body">
                    <h5 class="card-title">{!! html_entity_decode($item->snippet->title) !!}</h5>
                    <p class="card-text">■チャンネル：{!! html_entity_decode($item->snippet->channelTitle) !!}&nbsp;&nbsp;
                        ■チャンネルID：{{ $item->snippet->channelId }}</p>
                    <p class="card-text">{!! html_entity_decode($item->snippet->description) !!}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
