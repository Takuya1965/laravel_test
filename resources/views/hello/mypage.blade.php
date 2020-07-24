@extends('layouts.hellotest')

@section('title', $title)

@section('menubar')
    @parent
    @include('components.menu', ['page' => $title])
@endsection

@section('content')
    @if(Auth::check())
        <p>{{$user->name . '(' . $user->email . ')さん'}}のマイページ / <a href="logout">ログアウト</a></p>
        <div>
            <h3>プロフィールを編集</h3>
            <br>
            <h4>アイコン画像</h4>
            @if($icon != '')
                <img src="{{$icon}}" width="200" height="200">
            @endif
            <form action="/upload" method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" value="{{old('file')}}">
                <input type="submit" value="アップロード">
            </form>
            <br>
            <h4>プロフィールコメント</h4>
            <form action="/edit" method="post">
                @csrf
                @if($user->person != null)
                    <textarea name="profile" cols="30" rows="10">{{$user->person->profile}}</textarea>
                @else
                    <textarea name="profile" cols="30" rows="10"></textarea>
                @endif
                <input type="submit" value="変更">
            </form>
        </div>
        <br>
        <div>
            @include('components.talk', [])
            {{$talks->links()}}
        </div>
    @else
        <p>※ログインしていません（<a href="/login">ログイン</a>|<a href="/register">登録</a>）</p>
    @endif
@endsection

@section('footer')
copyright 2020 Ihara.
@endsection