<?php

namespace ManuelOjeda;

use Illuminate\Support\ServiceProvider;

class RatingServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/rating.php' => config_path('rating.php'),
            ], 'config');

            // $this->publishes([
            //     __DIR__.'/../resources/views' => base_path('resources/views/vendor/skeleton'),
            // ], 'views');

            if (! class_exists('CreateRatingTable')) {
                $this->publishes([
                    __DIR__ . '/../database/migrations/2020_05_23_235914_create_ratings_table.php' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_rating_table.php'),
                ], 'migrations');
            }
        }

        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'skeleton');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/rating.php', 'rating');
    }
}
