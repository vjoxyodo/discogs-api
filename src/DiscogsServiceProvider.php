<?php

namespace Vjoxyodo\DiscogsAPI;

use Illuminate\Support\ServiceProvider;
use Jolita\DiscogsApi\DiscogsApi;
use GuzzleHttp\Client;

class DiscogsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/discogs.php' => config_path('discogs.php'),
        ], 'config');
    }

	/**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/discogs.php', 'discogs');

        $this->app->singleton('discogs', function () {

            $config = config('discogs');

            return new DiscogsApi(app(Client::class), $config['token'], $config['headers']['User-Agent']);
        });

    }
}