<?php

namespace App\Providers;

use App\View\Components\Dashboard\Incomes;
use App\View\Components\Dashboard\Sidebar;
use App\View\Components\Dashboard\Statistics;
use App\View\Components\Dashboard\Table;
use Illuminate\Support\Facades\Blade;
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
        Blade::component(Sidebar::class, 'dashboard-sidebar');
        Blade::component(Statistics::class, 'dashboard-statistics');
        Blade::component(Incomes::class, 'dashboard-incomes');
        Blade::component(Table::class, 'dashboard-table');
    }
}
