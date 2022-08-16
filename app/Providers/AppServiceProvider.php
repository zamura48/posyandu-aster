<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
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
        // difne role is ketua
        Gate::define('ketua', function(User $user){
            return $user->role === 'Ketua';
        });

        // difine role is kader
        Gate::define('kader', function(User $user){
            return $user->role === 'Kader';
        });

        // difine role is ortu
        Gate::define('ibu_balita', function(User $user){
            return $user->role === 'Ibu Balita';
        });

        Gate::define('is_KaderAndKetua', function(User $user){
            return $user->role === 'Ketua' || $user->role === 'Kader';
        });
        Gate::define('is_KaderAndIbuBalita', function(User $user){
            return $user->role === 'Kader' || $user->role === 'Ibu Balita';
        });
    }
}
