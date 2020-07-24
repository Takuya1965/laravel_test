<?php
//Talkモデルクラス

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Talk extends Model
{
    use Searchable;
    protected $guarded = array('id');
    public static $rules = array(
        'user_id' => 'required',
        'comment' => 'required',
    );

    /**
     * 結合用のメソッド
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function people()
    {
        return $this->hasOne('App\Person', 'user_id', 'user_id');
    }
    /**
     * 検索用ローカルスコープ
     */
    public function scopeUserEqual($query, $int)
    {
        return $query->where('user_id', $int);
    }
}
