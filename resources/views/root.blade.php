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
                @for ($i = 0; $i < count($gameitems); $i++)
                @foreach($gameitems[$i] as $item)
                <div class="card" style="width: 28rem;">
                    <a href="/game/{{ $titles[$i] }}/{{ $item->id->videoId }}">
                        <img src="{{ $item->snippet->thumbnails->medium->url }}" class="d-block w-100" alt="...">
                    </a>
                    <div class="card-body">
                    <h5 class="card-title">{{ $item->snippet->title }}</h5>
                    <p class="card-text">{{ $item->snippet->description }}</p>
                    </div>
               </div>
                @endforeach
                @endfor
    </div>
    </div>
</div>
@endsection
