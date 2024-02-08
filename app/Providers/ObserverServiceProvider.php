<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Observers\UserObserver;
use App\Models\User;

use App\Observers\InventoryObserver;
use App\Models\Inventory;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        
    }
}
