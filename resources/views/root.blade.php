@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <ul class="nav nav-tabs pl-4">
            <li class="nav-item">
              <a class="nav-link 
              @if($typeid==1)
              active
              @endif
              " aria-current="page" href="/root/1">TVゲーム</a>
            </li>
            <li class="nav-item">
              <a class="nav-link
              @if($typeid==2)
              active
              @endif
              " href="/root/2">Android,iOS</a>
            </li>
        </ul>
    </div>
        @if($typeid==1)
        <ul>
            <div class="row">
                <h4>■TVゲーム</h4>
            </div>
            <div class="row">
                <h5>並び順：
                <a href="/root/1">おまかせ</a>&nbsp;/
                <a href="/root/1/1">タイトル 昇順</a>&nbsp;/
                <a href="/root/1/2">タイトル 降順</a>
            </h5>
            </div>
            <div class="row">
            <form method="POST" action="/root/1/filter">
                @csrf
                <div class="mb-3">
                    <label for="InputTitle" class="form-label">タイトル名で絞り込み：</label><br>
                    <input type="text" class="form-control" name="InputTitle" value="">
                    <input type="hidden" name="typeid" value="1">
                    <button type="submit" class="btn btn-primary">絞り込み</button>
                </div>
            </form>
            </div>
            <div class="row">
            @foreach ($gametitlealiases as $gametitlealiase)
                <a href="/game/1/{{ $gametitlealiase->title }}">{{ $gametitlealiase->title }}</a>
            /
            @endforeach
            </div>
        </ul>
        @endif
        @if($typeid==2)
        <ul>
            <div class="row">
            <h4>■Android,iOS</h4>
            </div>
            <div class="row">
                <h5>並び順：
                <a href="/root/2">おまかせ</a>&nbsp;/
                <a href="/root/2/1">タイトル 昇順</a>&nbsp;/
                <a href="/root/2/2">タイトル 降順</a>
            </h5>
            </div>
            <div class="row">
            <form method="POST" action="/root/2/filter">
                @csrf
                <div class="mb-3">
                    <label for="InputTitle" class="form-label">タイトル名で絞り込み：</label><br>
                    <input type="text" class="form-control" name="InputTitle" value="">
                    <input type="hidden" name="typeid" value="2">
                    <button type="submit" class="btn btn-primary">絞り込み</button>
                </div>
            </form>
            </div>
            <div class="row">
            @foreach ($mobiletitlealiases as $mobiletitlealias)
                <a href="/game/2/{{ $mobiletitlealias->title }}">{{ $mobiletitlealias->title }}</a>
            /
            @endforeach
            </div>
        </ul>
        @endif
</div>
@endsection
