<?php

namespace BrianFaust\Likeable;

use BrianFaust\ServiceProvider\ServiceProvider;

class LikeableServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishMigrations();
    }

    /**
     * Get the default package name.
     *
     * @return string
     */
    public function getPackageName()
    {
        return 'likeable';
    }
}
