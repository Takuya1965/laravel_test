<!--コンポーネントからの出力-->
<style>
    .talk_component{background-color:#ccffff; display:flex; align-items:center; width:80vw; padding:10px;}
    .user_icon{display:block; margin-right:20px;}
</style>
<div>
    <h3>{{$table}}</h3>
    @if(count($talks) == 0)
        <p>トークはありません。</p>
    @endif
    @foreach($talks as $talk)
        <div class="talk_component">
            <img src="/storage/{{$talk->people->icon}}" alt="{{$talk->user->name}}のアイコン画像" width="120" height="120" class="user_icon">
            <div>
                <h5><a href="profile/{{$talk->user->id}}">{{$talk->user->name}}</a></h5>
                <p>{{$talk->comment}}</p>
                <p>{{$talk->created_at}}</p>
            </div>
        </div>
    @endforeach
</div>