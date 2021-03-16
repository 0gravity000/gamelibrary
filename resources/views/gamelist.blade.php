@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="/root/{{$typeid}}">トップ画面へ戻る</a>
            <hr>
            <h2>{!! html_entity_decode($serachgamename) !!}&nbsp;の動画</h2>
            <a href="https://www.amazon.co.jp/gp/search?ie=UTF8&tag=0gravity000-22&linkCode=ur2&linkId=70ba0fbd7cd86ef756b12ea141133af2&camp=247&creative=1211&index=videogames&keywords={{$serachgamename}}" target="_blank" rel="noopener noreferrer">
                Amazonで{{$serachgamename}}をチェック
            </a>
            <hr>
            @foreach($searchlists as $searchlist)
            <div class="card">
                <div class="row g-0">
                    <div class="col-md-2">
                        <a href="/game/{{$typeid}}/{{ $serachgamename }}/{{ $searchlist->videoid }}">
                            <img class="mr-3" src="{{ $searchlist->thumbnails_defaulturl }}" alt="Generic placeholder image">
                        </a>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">
                            {!! html_entity_decode($searchlist->title) !!}
                            <!-- {{ $searchlist->title }} -->
                            </h5>
                            <p class="card-text"></p>
                        </div>
                    </div>
                </div>
            </div>

            <br>
            @endforeach
        </div>
    </div>
</div>
@endsection
