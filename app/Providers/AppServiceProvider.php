<?php

namespace App\Providers;

use App\Models\FoundItem;
use App\Observers\FoundItemObserver;
use Illuminate\Support\ServiceProvider;

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
        FoundItem::observe(FoundItemObserver::class);
    }
}
