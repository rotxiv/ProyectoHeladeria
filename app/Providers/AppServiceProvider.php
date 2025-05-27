<?php

namespace App\Providers;

use App\Listeners\LoginSuccessful;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Login;
use App\Models\Bitacora;


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
    public function boot(): void
    {
        /* Event::listen(
            Login::class,
            LoginSuccessful::class,
        );*/ 
        Event::listen(function (Login $event) {
           $this->login($event);
        });

        Event::listen(function (Logout $event) {
            $this->logout($event);
        });
    }

    private function login(Login $event) {
        Bitacora::create([
            'user_id' => $event->user->id,
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
        ]);
    }

    private function logout(Logout $event) {
        Bitacora::where('user_id', $event->user->id)
            ->whereNull('logged_out_at')
            ->latest('logged_in_at')
            ->first()
            ?->update(['logged_out_at' => now()]);
    }
}
