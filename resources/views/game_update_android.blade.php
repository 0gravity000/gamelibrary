@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="/admin">管理者メニュー</a> > 
            <a href="/admin/create_android">Androidゲームタイトルから別名を登録</a><br>
            <hr>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        
            <form method="POST" action="/admin/game_android">
                @csrf
                <div class="mb-3">
                    <label for="InputId" class="form-label">id</label>
                    <input type="text" class="form-control" name="InputId" value="{{ $game->id }}"><br>
                    <label for="InputTitle" class="form-label">タイトル名</label>
                    <input type="text" class="form-control" name="InputTitle" value="{{ $game->title }}"><br>
                </div>
                <button type="submit" class="btn btn-primary">登録</button>
            </form>
        </div>
    </div>
</div>
@endsection
