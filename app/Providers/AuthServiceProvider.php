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
         'App\Models\Post' => 'App\Policies\PostPolicy',
         'App\Models\User' => 'App\Policies\UserPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //policy
        //Gate::resource('post','App\Policies\PostPolicy');
    //     //use Gate
    //     Gate::define("post.update",function($user,$post){
    //         return $user->id === $post->user_id;
    //     });

    //     Gate::define("post.delete",function($user,$post){
    //         return $user->id === $post->user_id;
    //     });

    //     //allow admin
        Gate::before(function($user,$ability){
            if($user->is_admin && in_array($ability,["update"])){
                return true;
            }
        });
        
        Gate::define('secret.page',function($user){
            return $user->is_admin;
        });
    
 
     }
}
