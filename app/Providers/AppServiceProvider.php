<?php

namespace App\Providers;

use App\Models\Bar;
use App\Models\Sauna;
use App\Observers\BarObserver;
use App\Observers\SaunaObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
        Bar::observe(BarObserver::class);
        Sauna::observe(SaunaObserver::class);
    }
}
