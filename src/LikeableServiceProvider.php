<?php



declare(strict_types=1);



namespace BrianFaust\Likeable;

use BrianFaust\ServiceProvider\AbstractServiceProvider;

class LikeableServiceProvider extends AbstractServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        $this->publishMigrations();
    }

    /**
     * Get the default package name.
     *
     * @return string
     */
    public function getPackageName(): string
    {
        return 'likeable';
    }
}
