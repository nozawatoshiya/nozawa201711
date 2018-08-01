<?php

namespace App\Providers\Blade;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Larafm;


class AdminProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('admin',function(){
          $user=Larafm::Auth()->user();
          if($user->権限=='管理者'){
            return true;
          }else{
            return false;
          }
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
