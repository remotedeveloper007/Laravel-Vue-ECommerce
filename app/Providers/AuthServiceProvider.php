<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
        if (! $this->app->routesAreCached()) {
            Passport::routes();

            /**
             * If you would like to configure a shorter token lifetime, you may use 
             * the tokensExpireIn, refreshTokensExpireIn, and personalAccessTokensExpireIn methods
             */
            Passport::tokensExpireIn(now()->addMinutes(10));

            Passport::refreshTokensExpireIn(now()->addDays(7));
        
            Passport::personalAccessTokensExpireIn(now()->addMonths(1));             
        }        

 
        
        // ...
        // VerifyEmail::toMailUsing(function ($notifiable, $url) {
        //     return (new MailMessage)
        //         ->subject('Verify Email Address')
        //         ->line('Click the button below to verify your email address.')
        //         ->action('Verify Email Address', $url);
        // });        
    }
}
