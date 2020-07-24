<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Follow;
use App\User;


class FollowController extends Controller
{
    public function add($followee)
    {
        $user = Auth::user();

        $errorFlg = true;
        $follow;
        $record;
        $page;
        //フォロー相手が存在するか
        $exist = User::find($followee);
        if($exist != null)
        {
            //既にフォローしているか
            $follow = Follow::userEqual($user->id)->where('follow', $followee)->first();

            if($follow == null)
            {
                $errorFlg = false;

                $record = new Follow;
                $record->fill(['user_id' => $user->id, 'follow' => $followee])->save();
            }
            //既にフォローしていれば
            elseif($follow != null)
            {
                $errorFlg = false;
                //モデルインスタンスを削除
                $follow->delete();
            }
    
        }
        if($errorFlg === true)
        {
            $page = <<<EOL
            <p>フォロー相手が存在しません</p>
            <p><a href="/hello">トップ</a>へ戻る</p>
            EOL;
            return $page;
        }
        elseif($errorFlg === false)
        {
            return redirect('/profile/' . $followee);
        }
    }
}
