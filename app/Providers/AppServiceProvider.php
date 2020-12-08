<?php

namespace App\Providers;

use App\Models\{
    Category,
    Client,
    Plan,
    Product,
    Table,
    Tenant,
};
use App\Observers\{
    CategoryObserver,
    ClientObserver,
    PlanObserver,
    ProductObserver,
    TableObserver,
    TenantObserver,
};
use Illuminate\Support\Facades\Blade;
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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Plan::observe(PlanObserver::class);

        Product::observe(ProductObserver::class);

        Category::observe(CategoryObserver::class);

        Tenant::observe(TenantObserver::class);

        Client::observe(ClientObserver::class);

        Table::observe(TableObserver::class);

        Blade::if('admin', function () {
            $user = \auth()->user();
            return $user->isAdmin();
        });
    }
}
