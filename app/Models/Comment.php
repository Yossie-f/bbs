<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'comment_name',
        'body',
    ];

    //usersテーブルとのリレーションメソッド user()
    public function user(){
        //user : post = 1 : 多
        return $this->belongsTo(User::class);   
    }

    //postsテーブルとのリレーションメソッド user()
    public function post(){
        //post : comment = 1 : 多
        return $this->belongsTo(Post::class);   
    }
}
