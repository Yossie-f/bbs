<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // fillable = 充填可能
    //フォームからテーブルに入力する項目を配列で用意
    protected $fillable = [
        'user_id',
        'post_name',
        'title',
        'category_id',
        'body',
        'image',
        'url',
    ];

    //usersテーブルとのリレーションメソッド user()
    public function user(){
        return $this->belongsTo(User::class);
    }

    //category : post = 1 : 多
    public function category(){
        return $this->belongsTo(Category::class);   
    }

    //commentsテーブルとのリレーションメソッド comments()
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    
}
