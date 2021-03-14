@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="/admin">管理者メニュー</a> >
            <a href="/admin/request">Google Youtube APIのリクエストを登録・編集</a><br>
            <hr>
            <a href="/admin/request/create">新規作成</a>
            <div>
                @foreach($apirequests as $apirequest)
                <a href="/admin/request/{{ $apirequest->id }}">{{ $apirequest->id }}：{{ $apirequest->url }}
                part={{ $apirequest->part }}
                order={{ $apirequest->order }}
                type={{ $apirequest->type }}
                videocategoryid={{ $apirequest->videocategoryid }}
                maxresults={{ $apirequest->maxresults }}
                </a>
                <br>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
