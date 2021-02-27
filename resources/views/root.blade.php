@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="/game">ゲームを取得</a>
            <form method="POST" action="/game">
                @csrf
                <div class="mb-3">
                    <label for="InputGameName1" class="form-label">ゲーム名</label>
                    <input type="text" class="form-control" name="InputGameName1">
                    <div class="form-text">ゲーム名を指定してください。</div>
                </div>
                <button type="submit" class="btn btn-primary">検索する</button>
            </form>
        </div>
    </div>
</div>
@endsection
