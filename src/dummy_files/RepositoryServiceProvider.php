<?php
namespace App\Repositories;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

    /**
     * Register every single repository here a
     */
    public function register()
    {
        $this->app->bind('App\Repositories\User\UserRepository', 'App\Repositories\User\EloquentUserRepository');
    }
}