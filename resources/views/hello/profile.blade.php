@extends('layouts.hellotest')

@section('title', $title)

@section('menubar')
    @parent
    @include('components.menu', ['page' => $title])
@endsection

@section('content')
    @if(Auth::check())
        <p>ユーザー：{{$user->name . '(' . $user->email . ')さん'}} / <a href="/logout">ログアウト</a></p>
        <br>
        <div class="profile_box">
            <h3>{{$profile->user->name}}さんのプロフィール</h3>
            <h4>アイコン画像</h4>
            <img src="{{$icon}}" alt="{{$profile->user->name}}のアイコン画像" width="200" height="200">
            <h4>プロフィールコメント</h4>
            <p>{{$profile->profile}}</p>
        </div>
        <!--フォローしていなければ、フォローボタン-->
        @if($follow != null)
        <p>{{$profile->user->name}}さんをフォローしています / <a href="/follow/follows/{{$profile->user_id}}">フォロー解除</a></p>
        @else
        <p>{{$profile->user->name}}さんを<a href="/follow/follows/{{$profile->user_id}}">フォロー</a></p>
        @endif
        <div>
            @include('components.talk', ['table' => $profile->user->name . 'さんのトーク履歴'])
            {{$talks->links()}}
        </div>

    @else
        <p>※ログインしていません（<a href="/login">ログイン</a>|<a href="/register">登録</a>）</p>
    @endif
@endsection

@section('footer')
copyright 2020 Ihara.
@endsection