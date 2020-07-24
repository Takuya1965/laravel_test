<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'user_id' => 'required',
    );

    /**
     * 結合用のメソッド
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
