<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\IRepositories\{
    IProductRepository,
    IOrderRepository
};
use App\Repositories\Eloquent\{
    ProductRepository, 
    OrderRepository
};

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IOrderRepository::class, OrderRepository::class);
        $this->app->bind(IProductRepository::class, ProductRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
