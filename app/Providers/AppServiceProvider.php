<?php

namespace App\Providers;

use App\Contracts\Repositories\Proxy\ProxyIpContract;
use App\Repositories\Proxy\ProxyIpRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProxyIpContract::class, ProxyIpRepository::class);
    }
}
