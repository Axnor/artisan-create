<?php
namespace Khuesmann\ArtisanCreate;

use Illuminate\Support\ServiceProvider;

class ArtisanCreateServiceProvider extends ServiceProvider {

    public function register()
    {

        // Register create:model
        $this->registerCreateRepository();
        $this->commands('CreateRepository');
    }

    private function registerCreateRepository()
    {
        $this->app['CreateRepository'] = $this->app->share(function ($app)
        {
            return new CreateRepository();
        });
    }
}