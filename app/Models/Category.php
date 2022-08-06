<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_name',
        'user_id',
        'summary',
    ];

    //user : category = 1 : 多
    public function user(){
        return $this->belongsTo(User::class);
    }

    //post : category = 多 : 1
    public function posts(){
        return $this->hasMany(Post::class);
    }

    
}
