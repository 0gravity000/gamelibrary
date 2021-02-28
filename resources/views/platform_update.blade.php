@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="/admin">管理者メニュー</a> > 
            <a href="/admin/platform">プラットフォームを編集</a><br>
            <hr>
            <form method="POST" action="/admin/platform">
                @csrf
                <div class="mb-3">
                    <label for="InputId" class="form-label">id</label>
                    <input type="text" name="InputId" value="{{ $platform->id }}"><br>
                    <label for="InputName" class="form-label">プラットフォーム名</label>
                    <input type="text" name="InputName" value="{{ $platform->name }}"><br>
                </div>
                <button type="submit" class="btn btn-primary">更新</button>
            </form>
        </div>
    </div>
</div>
@endsection
