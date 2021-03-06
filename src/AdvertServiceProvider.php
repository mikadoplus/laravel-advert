<?php
namespace Adumskis\LaravelAdvert;

use Illuminate\Support\ServiceProvider;

class AdvertServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        $this->loadViewsFrom(__DIR__.'/../view', 'AdvMng');
        
        // Publish your migrations
        $this->publishes([
            __DIR__.'/../migrations/2016_03_11_202301_create_advert_categories_table.php' => database_path('migrations/2016_03_11_202301_create_advert_categories_table.php'),
            __DIR__.'/../migrations/2016_03_11_202607_create_adverts_table.php' => database_path('migrations/2016_03_11_202607_create_adverts_table.php')
        ], 'migrations');

        // Publishes view files
        $this->publishes([
            __DIR__.'/../view/advert.blade.php' => resource_path('views/partials/advert.blade.php'),
            __DIR__.'/../view/advertSlider.blade.php' => resource_path('views/partials/advertSlider.blade.php'),
        ], 'views');

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('advert_manager', function() {
            return new AdvertManager();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['advert_manager'];
    }
}
