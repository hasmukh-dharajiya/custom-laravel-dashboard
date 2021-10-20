<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

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
        view()->composer('layout.alert', function ($view) {
            $name = null;
            $verify_at = null;
            $email_id = Auth::user()->email;
            $user = DB::table('users')->select('confirmed','name')->where('email',$email_id)->first();
            if ($user->confirmed == 1){
                $verify_at = true;
            }
            else{
                $name = $user->name;
                $verify_at = false;
            }
            return $view->with(['verify_at'=>$verify_at,'user_name'=>$name,'email_id'=>$email_id]);
        });

        view()->composer('layout.navbar', function ($view) {
            $email_id = '';
            $avatar = '';
            if (Auth::check()){
                $email_id = Auth::user()->email ?? '';
                $avatar = $avatar = strtoupper(substr($email_id, 0,1));
            }
            return $view->with(['avatar'=>$avatar,'email_id'=>$email_id]);
        });
    }
}
