<?php

namespace LaravelFanatic\Socketer;

use Illuminate\Support\ServiceProvider;
use LaravelFanatic\Socketer\Commands\ServeSocketerCommand;

class SocketerServiceProvider extends ServiceProvider {

    /**
    * Indicates if loading of the provider is deferred.
    *
    * @var bool
    */
    protected $defer = false;

    public function boot()
    {
        $this->package('laravelfanatic/socketer');
    }
    /**
    * Register the service provider.
    *
    * @return void
    */
    public function register()
    {
        $this->registerCommands();
    }

    private function registerCommands(){
        $this->app['socketer.serve'] = $this->app->share(function($app){
            return new ServeSocketerCommand($app);
        });
        $this->commands('socketer.serve');
    }


    /**
    * Get the services provided by the provider.
    *
    * @return array
    */
    public function provides()
    {
        return array();
    }

}
