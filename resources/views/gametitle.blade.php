@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <p>管理者メニュー</p>
            <a href="/admin">管理者メニューのTOPに戻る</a><br>
            <a href="/admin/edit">ゲームタイトルを編集</a><br>
            <div>
                <ol>
                    @foreach($title_lists[0] as $list)
                    <li>{{ $list }}</li>
                    @endforeach
                    @foreach($title_lists[1] as $list)
                    <li>{{ $list }}</li>
                    @endforeach
                </ol>
            </div>
    </div>
    </div>
</div>
@endsection
