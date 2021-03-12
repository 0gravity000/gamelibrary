@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <p>管理者メニュー</p>
            <a href="/admin">管理者メニュー</a> > 
            <a href="/admin/create_android">Androidゲームタイトルから別名を登録</a><br>
            <hr>
            <div>
                @foreach($games as $game)
                <a href="/admin/game_android/{{ $game->id }}">{{ $game->id }}：{{ $game->title }}</a><br>
                @endforeach
            </div>
    </div>
    </div>
</div>
@endsection
