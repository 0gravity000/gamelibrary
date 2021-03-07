@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="/admin">管理者メニュー</a> > 
            <a href="/admin/request">Google Youtube APIのリクエストを登録・編集</a><br>
            <hr>
            <form method="POST" action="/admin/request/store">
                @csrf
                <h3><a href="https://developers.google.com/youtube/v3/docs/search/list?hl=ja" target="_blank" rel="noopener noreferrer">
                    Google Youtube APIリファレンス Search: list</a>
                </h3>
                <div class="mb-3">
                    <label for="InputId" class="form-label">id</label>
                    <input type="text" name="InputId" class="form-control" value="" readonly><br>
                    <label for="InputUrl" class="form-label">リクエストURL</label>
                    <input type="text" name="InputUrl" class="form-control" value="https://www.googleapis.com/youtube/v3/search"><br>
                    <label for="InputParamPart" class="form-label">パラメータ：part</label>
                    <input type="text" name="InputParamPart" class="form-control" value="snippet"><br>
                    <label for="InputParamOrder" class="form-label">パラメータ：order</label>
                    <input type="text" name="InputParamOrder" class="form-control" value="rating"><br>
                    <label for="InputParamType" class="form-label">パラメータ：type</label>
                    <input type="text" name="InputParamType" class="form-control" value="video"><br>
                    <label for="InputParamVideocategoryid" class="form-label">videocategoryid</label>
                    <input type="text" name="InputParamVideocategoryid" class="form-control" value="20"><br>
                    <label for="InputParamMaxresults" class="form-label">maxresults</label>
                    <input type="text" name="InputParamMaxresults" class="form-control" value="50"><br>
                </div>
                <button type="submit" class="btn btn-primary">登録</button>
            </form>
        </div>
    </div>
</div>
@endsection
