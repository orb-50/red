<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Ticket;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        App\Models\ticket::class=>App\Policies\TicketPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('user', function (User $user) {
            return $user->role == 3;
        });
        
        Gate::define('stuff', function (User $user) {
            return $user->role == 2;
        });

        Gate::define('administrator', function (User $user) {
            return $user->role == 1;
        });

        Gate::define('ticket-post', function (User $user, Ticket $ticket) {
            return $user->id === $ticket->user_id;
        });

        Gate::define('edit', function (User $user,$id) {
            if($user->id == $id||$user->role==1){
                return true;
            }
            return false;
        });

        
    }
}
