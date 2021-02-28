@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="/admin">管理者メニュー</a> > 
            <a href="/admin/platform">プラットフォームを編集</a><br>
            <hr>
            <a href="/admin/platform/0">新規作成</a>
            <div>
                @foreach($platforms as $platform)
                <a href="/admin/platform/{{ $platform->id }}">{{ $platform->id }}：{{ $platform->name }}</a><br>
                @endforeach
            </div>
    </div>
    </div>
</div>
@endsection
