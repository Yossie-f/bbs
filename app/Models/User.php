<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\NewVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'avatar',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //postsテーブルとのリレーションメソッド posts()
    public function posts(){
        return $this->hasMany(Post::class);
    }

    //commentsテーブルとのリレーションメソッド comments()
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    //rolesテーブルとのリレーション
    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    //Eメール登録時のメール通知
    public function sendEmailVerificationNotification()
    {
        $this->notify(new NewVerifyEmail());
    }
}
