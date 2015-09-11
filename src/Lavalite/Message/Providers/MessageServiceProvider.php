<?php

namespace Lavalite\Message\Providers;

use Illuminate\Support\ServiceProvider;

class MessageServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../../../../resources/views', 'message');
        $this->loadTranslationsFrom(__DIR__.'/../../../../resources/lang', 'message');

        $this->publishResources();
        $this->publishMigrations();

        include __DIR__ . '/../Http/routes.php';
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('message', function ($app) {
            return $this->app->make('Lavalite\Message\Message');
        });

        $this->app->bind(
            'Lavalite\\Message\\Interfaces\\MessageRepositoryInterface',
            'Lavalite\\Message\\Repositories\\Eloquent\\MessageRepository'
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('message');
    }

    /**
     * Publish resources.
     *
     * @return  void
     */
    private function publishResources()
    {
        $this->publishes([__DIR__.'/../../../../config/config.php' => config_path('message.php')], 'config');

        // Config merge add here
    }

    /**
     * Publish migration and seeds.
     *
     * @return  void
     */
    private function publishMigrations()
    {
        $this->publishes([__DIR__.'/../../../../database/migrations/' => base_path('database/migrations')], 'migrations');
        $this->publishes([__DIR__.'/../../../../database/seeds/' => base_path('database/seeds')], 'seeds');
    }


}
