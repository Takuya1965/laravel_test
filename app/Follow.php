<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'user_id' => 'required',
        'follow' => 'required',
    );

    /**
     * 結合用のメソッド
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * ローカルスコープ
     */
    public function scopeUserEqual($query, $int)
    {
        return $query->where('user_id', $int);
    }
}
