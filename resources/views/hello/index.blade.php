@extends('layouts.hellotest')

@section('title', $title)

@section('menubar')
    @parent
    @include('components.menu', ['page' => $title,])
@endsection

@section('content')
    @if(Auth::check())
        <p>ユーザー：{{$user->name . '(' . $user->email . ')さん'}} / <a href="logout">ログアウト</a></p>
        @include('components.talk', ['table' => $table, 'talks' => $talks,])
        {{$talks->links()}}
    @else
        <p>※ログインしていません（<a href="login">ログイン</a>|<a href="register">登録</a>）</p>
    @endif
@endsection

@section('footer')
copyright 2020 Ihara.
@endsection