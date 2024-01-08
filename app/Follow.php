<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    //↓フォロー、フォロワーのリレーションの中間テーブル
    protected $fillable = ['following_id','followed_id'];

    protected $table = 'follows';
}
