<?php

namespace App\Repository;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider{

    public function register()
    {
        $this->app->bind(
            'App\Repository\UserInterface',
            'App\Repository\UserRepository'
        );
    }
}