<?php
namespace Repositories;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider {

    /**
     * Register every single repository here a
     */
    public function register()
    {
        $this->app->bind('Repositories\User\UserRepository', 'Repositories\User\EloquentUserRepository');
        $this->app->bind('Repositories\Post\PostRepository', 'Repositories\Post\EloquentPostRepository');
    }
}