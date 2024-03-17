<?php

namespace App\Providers;

use App\Interfaces\IBrandRepository;
use App\Interfaces\IOutletRepository;
use App\Interfaces\IProductRepository;
use App\Repositories\BrandRepository;
use App\Repositories\OutletRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IBrandRepository::class, BrandRepository::class);
        $this->app->bind(IOutletRepository::class, OutletRepository::class);
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
