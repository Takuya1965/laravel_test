@extends('layouts.hellotest')

@section('title', $title)

@section('menubar')
    @parent
    @include('components.menu', ['page' => $title])
@endsection

@section('content')
    @if(Auth::check())
        <p>ユーザー：{{$user->name . '(' . $user->email . ')さん'}} / <a href="logout">ログアウト</a></p>
        <br>
        <p>トークを記入してください。</p>
        <!--入力エラーをチェック-->
        @if(count($errors) > 0)
            <div>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="speach" method="post">
            @csrf
            <input type="hidden" name="user_id" value="{{$user->id}}">
            <textarea cols="70" rows="10" name="comment">{{old('comment')}}</textarea>
            <input type="submit" value="送信">
        </form>
    @else
        <p>※ログインしていません（<a href="login">ログイン</a>|<a href="register">登録</a>）</p>
    @endif
@endsection

@section('footer')
copyright 2020 Ihara.
@endsection