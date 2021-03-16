@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="/admin">管理者メニュー</a> > 
            <a href="/admin/edit">ゲームタイトルの別名を編集</a><br>
            <hr>
            <form method="POST" action="/admin/gamealias">
                @csrf
                <div class="mb-3">
                    <label for="InputId" class="form-label">id</label>
                    <input type="text" class="form-control" name="InputId" value="{{ $gametitlealiase->id }}"><br>
                    <label for="InputTitle" class="form-label">タイトル名</label>
                    <input type="text" class="form-control" name="InputTitle" value="{{ $gametitlealiase->title }}"><br>
                </div>
                <button type="submit" class="btn btn-primary" name="regist">登録</button>
                <button type="submit" class="btn btn-primary" name="delete">削除</button>
            </form>
        </div>
    </div>
</div>
@endsection
