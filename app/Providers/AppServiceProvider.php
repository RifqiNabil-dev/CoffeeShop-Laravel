<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        View::composer('layouts.nav', function ($view) {
            if (Auth::id()) {
                
                $user = Auth::user();
                $userid = $user->id;
                $count = Cart::where('user_id', $userid)->count();// Data yang ingin dikirim
            }else{
                $count = '';
            }

            $view->with('count', $count);
        });

        View::composer('order', function ($view) {
            if (Auth::id()) {
                
                $user = Auth::user();
                $userid = $user->id;
                $count = Cart::where('user_id', $userid)->count();// Data yang ingin dikirim
            }else{
                $count = '';
            }

            $view->with('count', $count);
        });
    }
}
