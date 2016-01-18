<?php

namespace DraperStudio\Likeable;

use DraperStudio\ServiceProvider\ServiceProvider as BaseProvider;

class ServiceProvider extends BaseProvider
{
    protected $packageName = 'likeable';

    public function boot()
    {
        $this->setup(__DIR__)
             ->publishMigrations();
    }

    public function register()
    {
        //
    }
}
