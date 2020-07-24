@if($page == 'トークルーム')
    {{$page}}</li>
@else
    <a href="/hello">トークルーム</a></li>
@endif
@if($page == 'マイページ')
    <li>{{$page}}</li>
@else
    <li><a href="/profile">マイページ</a></li>
@endif
@if($page == 'トークする')
    <li>{{$page}}</li>
@else
    <li><a href="/speach">トークする</a></li>
@endif
@if($page == '検索する')
    <li>{{$page}}</li>
@else
    <li><a href="/search">検索する</a></li>
@endif