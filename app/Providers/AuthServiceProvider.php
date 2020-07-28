<?php

namespace App\Providers;

use App\Auth as AuthProvider;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @todo: - Handle 'eloquent' more elegant
     * @todo: - Switch isn't exactly beautiful. Maybe create convention for class naming in accordance to AUTH_METHOD?
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        
        // Just return true on builtin method 
        if (env('AUTH_METHOD') == 'eloquent') return true;

        Auth::provider(env('AUTH_METHOD'), function() {
            switch (env('AUTH_METHOD')) {
                case 'alma': 
                    return new AuthProvider\AlmaUserProvider(new User());
                    break;
                case 'paia': 
                    return new AuthProvider\PaiaUserProvider(new User());
                    break;                
                //default:
                    // throw error...
            }
            
        });

    }
}
