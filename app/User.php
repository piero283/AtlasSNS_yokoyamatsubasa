<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //記載されたカラム名のみ更新が可能
    protected $fillable = [
        'username', 'mail', 'password', 'bio', 'images',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //Followモデルとのリレーション
    //多対多
    //フォロワー→フォロー
    // public function follows(){
    //     return $this->belongsToMany('App\User', 'follows', 'followed_id', 'following_id');
    // }
    // //フォロー→フォロワーusers()←怪しい
    // public function users(){
    //     return $this->belongsToMany('App\User', 'follows', 'following_id', 'followed_id');
    // }

    //Postモデルとのリレーション
    //1対多の多
    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function followers()//フォロワーを取得
    {
        return $this->belongsToMany(self::class, 'follows', 'followed_id', 'following_id');
    }

    public function follows()//フォローしてるユーザーを取得
    {
        return $this->belongsToMany(self::class, 'follows', 'following_id', 'followed_id');
    }

    public function follow(Int $user_id)//ユーザーをフォロー
    {
        return $this->follows()->attach($user_id);
    }

    public function unfollow(Int $user_id)//ユーザーのフォローを解除
    {
        return $this->follows()->detach($user_id);
    }

    public function isFollowing(Int $user_id)//フォローしてるかを確認
    {
        return (boolean) $this->follows()->where('followed_id', $user_id)->first();
    }

    public function post()
    {
        return $this->hasMany(Post::class);
    }


}
