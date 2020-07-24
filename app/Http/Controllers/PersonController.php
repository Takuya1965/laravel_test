<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class PersonController extends Controller
{
    public function upload(Request $request)
    {
        $user = Auth::user();

        //送信されたファイルのバリデーション
        $validate_rule = [
            'file' => 'required',
        ];
        $this->validate($request, $validate_rule);
        $icon_path = Storage::disk('public')->putFile('icons', $request->file('file'));

        $person;
        $data;
        //Personレコードがあれば
        if($user->person != null)
        {
            $person = Person::where('user_id', $user->id)->first();
            $person->icon = $icon_path;
            $person->save();
        }
        else
        {
            $person = new Person;
            $data = [
                'user_id' => $user->id,
                'icon' => $icon_path,
                'profile' => '',
            ];
            $person->fill($data)->save();
        }
        return redirect('/profile');
    }

    public function edit(Request $request)
    {
        $user = Auth::user();

        $icon = 'icons/SCtpHtDavFGnc4Ra5rlzX66lCsuIbnScQOq36fOs.png';
        $person;
        $data;
        $profile = $request->profile;
        //Personレコードがあれば
        if($user->person != null)
        {
            $person = Person::where('user_id', $user->id)->first();
            $person->profile = $profile;
            $person->save();
        }
        else
        {
            $person = new Person;
            $data = [
                'user_id' => $user->id,
                'icon' => $icon,
                'profile' => $profile,
            ];
            $person->fill($data)->save();
        }
        return redirect('/profile');        
    }
}
