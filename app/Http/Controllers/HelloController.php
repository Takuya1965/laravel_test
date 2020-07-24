<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Person;
use App\Talk;
use App\Follow;

class HelloController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $profile = Person::where('user_id', $user->id)->first();
        $data;
        $icon = 'icons/SCtpHtDavFGnc4Ra5rlzX66lCsuIbnScQOq36fOs.png';
        if($profile == null)
        {
            $profile = new Person;
            $data = [
                'user_id' => $user->id,
                'comment' => '',
                'icon' => $icon,
            ];
            $profile->fill($data)->save();
        }
        $talks = Talk::orderBy('created_at', 'desc')->paginate(5);
        $param = [
            'user' => $user,
            'talks' => $talks,
            'title' => 'トークルーム',
            'table' => 'みんなのトーク',
        ];
        return view('hello.index', $param);
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect('/hello');
    }

    public function speach()
    {
        $user = Auth::user();
        $param = [
            'user' => $user,
            'title' => 'トークする',
        ];
        return view('hello.speach', $param);
    }

    public function doSpeach(Request $request)
    {
        $user = Auth::user();
        
        $this->validate($request, Talk::$rules);
        $talk = new Talk;
        $form = $request->all();
        unset($form['_token']);
        $talk->fill($form)->save();

        return redirect('/hello');
    }

    public function profile($user_id = 'noId')
    {
        $user = Auth::user();

        $items = [];
        $profile;
        $icon;
        $follow;
        $talks;
        if($user_id == $user->id || $user_id == 'noId')
        {
            $profile = '';
            $icon = '';
            if($user->person != null)
            {
                $icon = $user->person->icon;
                $profile = Storage::url($icon);
            }
            $talks = Talk::userEqual($user->id)->orderBy('created_at', 'desc')->paginate(2);
            $items = [
                'user' => $user,
                'title' => 'マイページ',
                'icon' => $profile,
                'table' => 'トーク履歴',
                'talks' => $talks,
            ];
            return view('hello.mypage', $items);
        }
        else
        {
            $profile = Person::where('user_id', $user_id)->first();

            if($profile != null){
                $icon = Storage::url($profile->icon);
                //ユーザーが相手をフォローしているか
                $follow = Follow::userEqual($user->id)->where('follow', $user_id)->first();
                //トーク履歴を取得
                $talks = Talk::userEqual($user_id)->orderBy('created_at', 'desc')->paginate(5);
                $items = [
                    'user' => $user,
                    'title' => $profile->user->name . 'さんのページ',
                    'profile' => $profile,
                    'icon' => $icon,
                    'follow' => $follow,
                    'talks' => $talks,
                ];
                return view('hello.profile', $items);
            }
            else    //id又はプロフィールが存在しない場合はトップページへのリンク
            {
                $profile = <<<EOL
                <p>プロフィールが存在しません。</p>
                <a href="/hello">トップページに戻る</a>
                EOL;
                return $profile;
            }
        }
    }

    public function search()
    {
        $user = Auth::user();

        $title = '検索する';
        $data = [
            'user' => $user,
            'title' => $title,
        ];
        return view('hello.search', $data);
    }

    public function doSearch(Request $request)
    {
        $user = Auth::user();
        $title = '検索結果';

        $validate_rule = [
            'search' => 'required',
        ];
        $this->validate($request, $validate_rule);
        $search = '%' . $request->search . '%';

        $talks = Talk::whereHas('user', function($query) use($search){
            $query->where('name', 'like', $search);
        })->orWhere('comment', 'like', $search)->orderBy('created_at', 'desc')->paginate(5);
        //$talks = Talk::orderBy('created_at', 'desc')->paginate(5);

        $items = [
            'user' => $user,
            'title' => $title,
            'search' => $request->search,
            'talks' => $talks,
        ];
        return view('hello.search', $items);
    }
}
