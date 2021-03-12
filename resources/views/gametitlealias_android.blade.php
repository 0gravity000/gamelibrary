@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <p>管理者メニュー</p>
            <a href="/admin">管理者メニュー</a> > 
            <a href="/admin/edit_android">Androidゲームタイトルの別名を編集</a><br>
            <hr>
            <div>
                @foreach($gametitlealiases as $gametitlealias)
                <a href="/admin/gamealias_android/{{ $gametitlealias->id }}">{{ $gametitlealias->id }}：{{ $gametitlealias->title }}</a><br>
                元のタイトル名：{{ $gametitlealias->mobile_game->title }}<br>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
