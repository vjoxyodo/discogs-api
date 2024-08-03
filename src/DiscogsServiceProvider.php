<?php

namespace Vjoxyodo\DiscogsApi;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;

class DiscogsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/discogs-api.php' => config_path('discogs-api.php'),
        ], 'config');
        
		if ($this->app->runningInConsole()) {
	        $this->commands([
	            \Vjoxyodo\DiscogsApi\Commands\AddDiscogsAuth::class,
	        ]);
	    }
    }

	/**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/discogs-api.php', 'discogs-api');
        
        $this->app->singleton('discogs-api', function () {

            $config = config('discogs-api');
 
            return new DiscogsApi();
        });
        
		config([
            'config/discogs-api.php',
        ]);

    }
}