<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //どのテーブルを使用するかの指定
    protected $table = 'posts';

    //Userモデルとのリレーション
    //1対多の1
    public function user(){
        return $this->belongsTo('App\User');
    }
}
