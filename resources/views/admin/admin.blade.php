@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <p>管理者メニュー</p>
            <hr>
            <a href="/admin/download">ゲームタイトルのダウンロード</a><br>
            <a href="/admin/create">ゲームタイトルから別名を登録</a><br>
            <a href="/admin/edit">ゲームタイトルの別名を編集</a><br>
            <a href="/admin/platform">プラットフォームを登録</a><br>
            <br>
            <a href="/admin/download_androidgame">Androidゲームタイトルのダウンロード</a><br>
            <br>
            <a href="/admin/request">Google Youtube APIのリクエストを登録・編集</a>
        </div>
    </div>
</div>
@endsection
