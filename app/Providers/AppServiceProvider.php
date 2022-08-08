<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //↓デプロイ後、HTTTPS通信にするため.envファイルの"FORCE_HTTPS=false"を"true"にする
        if(env('FORCE_HTTPS',false)) {
            URL::forceScheme('https');
        }

    }
}
