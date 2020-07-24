@extends('layouts.hellotest')

@section('title', $title)

@section('menubar')
    @parent
    @include('components.menu', ['page' => $title,])
@endsection

@section('content')
    @if(Auth::check())
        <p>ユーザー：{{$user->name . '(' . $user->email . ')さん'}} / <a href="/logout">ログアウト</a></p>
        <br>
        @if(!empty($talks))
            @include('components.talk', ['table' => '「' . $search . '」の検索結果　全' . $talks->total() . '件', 'talks' => $talks,])
            {{$talks->appends(['search' => $search ?? ''])->links()}}
            <br>
        @endif
        <h3>検索する</h3>
        <p>
            トークを検索できます。<br>
            キーワードを入力してください。
        </p>
        <form action="/result" method="get">
            @csrf
            @if(count($errors) > 0)
            <div>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <label for="search">キーワード：</label>
            <input type="text" name="search" value="{{old('search')}}" id="search">
            <input type="submit" value="検索">
        </form>
    @else
        <p>※ログインしていません（<a href="login">ログイン</a>|<a href="register">登録</a>）</p>
    @endif
@endsection

@section('footer')
copyright 2020 Ihara.
@endsection