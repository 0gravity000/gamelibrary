@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="/root">戻る</a>

            @foreach($gameitems as $item)
            <div class="media">
                <a href="/game/{{ $serachgamename }}/{{ $item->id->videoId }}">
                    <img class="mr-3" src="{{ $item->snippet->thumbnails->default->url }}" alt="Generic placeholder image">
                </a>
                <div class="media-body">
                    {{ $item->snippet->title }}
                </div>
            </div>
            <br>
            @endforeach            
        </div>
    </div>
</div>
@endsection
