<?php
namespace Khuesmann\ArtisanCreate;

use Illuminate\Support\ServiceProvider;

class ArtisanCreateServiceProvider extends ServiceProvider {

    public function register()
    {

        // Register create:model
        $this->registerCreateModel();
        $this->commands('CreateModel');

        // Register create:controller
        $this->registerCreateController();
        $this->commands('CreateController');

    }

    private function registerCreateModel()
    {
        $this->app['CreateModel'] = $this->app->share(function($app)
        {
            return new CreateModel();
        });
    }

    private function registerCreateController()
    {
        $this->app['CreateController'] = $this->app->share(function($app)
        {
            return new CreateController();
        });
    }



}