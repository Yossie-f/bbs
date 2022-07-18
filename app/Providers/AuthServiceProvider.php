<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //Postモデルに対してPostPolicyクラスを設定する
        App\Models\Post::class=>App\Policies\PostPolicy::class,  
        //UserモデルにUserPolicyクラスを設定
        App\Models\User::class=>App\Policies\UserPolicy::class,  
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //Gateクラスのdefineメソッド
        Gate::define('admin', function($user){ //$userはログインユーザー
            foreach($user->roles as $role){
                if($role->role=='admin'){
                    //ユーザーのroleが’admin’であればtrueを返し、ゲートを通ることができる。
                    return true;
                }
            }
            return false; //adminでなければfalseを返しゲートを通れない。
        });
    }
}
