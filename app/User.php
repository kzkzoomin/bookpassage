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
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    
    // フォロー多対多定義
    public function followings()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id')->withTimestamps();
    }

    // フォロワー多対多定義
    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'follow_id', 'user_id')->withTimestamps();
    }
    
    // フォローする
    public function follow($userId)
    {
        // 既にフォローしているかの確認
        $exist = $this->is_following($userId);
        // 相手が自分自身ではないかの確認
        $its_me = $this->id == $userId;
    
        if ($exist || $its_me) {
            // 既にフォローしていれば何もしない
            return false;
        } else {
            // 未フォローであればフォローする
            $this->followings()->attach($userId);
            return true;
        }
    }
    
    // フォロー解除
    public function unfollow($userId)
    {
        // 既にフォローしているかの確認
        $exist = $this->is_following($userId);
        // 相手が自分自身ではないかの確認
        $its_me = $this->id == $userId;
    
        if ($exist && !$its_me) {
            // 既にフォローしていればフォローを外す
            $this->followings()->detach($userId);
            return true;
        } else {
            // 未フォローであれば何もしない
            return false;
        }
    }
    
    // フォロー状態判定
    public function is_following($userId)
    {
        return $this->followings()->where('follow_id', $userId)->exists();
    }
    
    // タイムライン表示
    public function feed_posts()
    {
        $follow_user_ids = $this->followings()->pluck('users.id')->toArray();
        $follow_user_ids[] = $this->id;
        return Post::whereIn('user_id', $follow_user_ids);
    }
    
    // ふぁぼ定義
    public function favorites()
    {
        return $this->belongsToMany(Post::class, 'favorites', 'user_id', 'post_id')->withTimestamps();
    }
    
    // ふぁぼる
    public function like($postId){
        // 既にふぁぼってるか確認
        $exist = $this->liked($postId);
        
        if ($exist) {
            // 既にふぁぼってれば何もしない
            return false;
        } else {
            // 未ふぁぼであれば登録する
            $this->favorites()->attach($postId);
            return true;
        }
    }
    
    // あんふぁぼ
    public function unlike($postId){
        // 既にふぁぼってるか確認
        $exist = $this->liked($postId);
        
        if ($exist) {
            // 既にふぁぼってればふぁぼ解除
            $this->favorites()->detach($postId);
            return true;
        } else {
            // 未ふぁぼであればなにもしない
            return false;
        }
    }
    
    // ふぁぼっている状態判定
    public function liked($postId)
    {
        return $this->favorites()->where('post_id', $postId)->exists();
    }
}
