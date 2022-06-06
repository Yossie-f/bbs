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
        'body',
        'image',
        'url',
    ];

    //usersテーブルとのリレーションメソッド user()
    public function user(){
        //user : post = 1 : 多
        return $this->belongsTo(User::class);   
    }
}
