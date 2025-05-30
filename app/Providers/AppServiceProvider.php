<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\TodolistService;
use App\Services\Impl\TodolistServiceimpl;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Binding interface ke implementasinya
        $this->app->bind(TodolistService::class, TodolistServiceImpl::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
