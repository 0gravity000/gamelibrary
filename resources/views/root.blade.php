@extends('layouts.app')

@section('content')
<div class="content">
    <div class="row">
    <!-- サイドバー -->
    <div class="col-md-4">
        <aside>
        <nav>
            <ul>
                @foreach ($gametitlealiases as $gametitlealiase)
                <li>
                    <a href="/game/{{ $gametitlealiase->title }}">{{ $gametitlealiase->title }}</a>
                </li>
                @endforeach
            </ul>
        </nav>
        </aside>
    </div>
    <div class="col-md-8">
        <h1>ピックアップ！</h1>
            @foreach ($searchlists as $searchlist)
            <div class="card" style="width: 28rem;">
                <h5 class="card-header">
                    {!! html_entity_decode($searchlist->gametitle_aliase->title) !!}
                </h5>
                <a href="/game/{{ $searchlist->gametitle_aliase->title }}/{{ $searchlist->videoid }}">
                    <img src="{{ $searchlist->thumbnails_mediumurl }}" class="d-block w-100" alt="...">
                </a>
                <div class="card-body">
                    <h5 class="card-title">{!! html_entity_decode($searchlist->title) !!}</h5>
                    <p class="card-text">{!! html_entity_decode($searchlist->description) !!}</p>
                </div>
           </div>
            @endforeach
    </div>
    </div>
</div>
@endsection
