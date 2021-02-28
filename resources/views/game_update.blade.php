@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="/admin">管理者メニュー</a> > 
            <a href="/admin/game">ゲームタイトルを編集</a><br>
            <hr>
            <form method="POST" action="/admin/game">
                @csrf
                <div class="mb-3">
                    <label for="InputId" class="form-label">id</label>
                    <input type="text" class="form-control" name="InputId" value="{{ $game->id }}"><br>
                    <label for="InputTitle" class="form-label">タイトル名</label>
                    <input type="text" class="form-control" name="InputTitle" value="{{ $game->title_original }}"><br>
                </div>
                <button type="submit" class="btn btn-primary">登録</button>
            </form>
        </div>
    </div>
</div>
@endsection
