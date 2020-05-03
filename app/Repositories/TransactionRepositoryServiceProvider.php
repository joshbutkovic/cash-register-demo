<?php

namespace App\Repositories;

use Illuminate\Support\ServiceProvider;

class TransactionRepositoryServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind('App\Repositories\TransactionRepositoryInterface', 'App\Repositories\TransactionRepository');
    }

}
