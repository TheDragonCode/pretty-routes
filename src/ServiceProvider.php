<?php
/**
 * This file is part of the "dragon-code/pretty-routes" project.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Andrey Helldar <helldar@dragon-code.pro>
 * @copyright 2024 Andrey Helldar
 * @license MIT
 *
 * @see https://github.com/TheDragonCode/pretty-routes
 */

namespace PrettyRoutes;

use DragonCode\LaravelSupport\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            $this->fullPath('config/pretty-routes.php'),
            'pretty-routes'
        );
    }

    public function boot()
    {
        if ($this->isDisabled()) {
            return;
        }

        $this->loadViewsFrom(
            $this->fullPath('resources/views'),
            'pretty-routes'
        );

        $this->publishes([
            $this->fullPath('config/pretty-routes.php') => $this->app->configPath('pretty-routes.php'),
            $this->fullPath('resources/views/styles.blade.php') => resource_path('views/vendor/pretty-routes/styles.blade.php'),
        ]);

        $this->loadRoutesFrom(
            $this->routesPath()
        );
    }

    protected function isDisabled(): bool
    {
        return Config::get('pretty-routes.debug_only', true) && ! Config::get('app.debug');
    }

    protected function fullPath(string $path): string
    {
        return realpath(__DIR__ . '/../' . ltrim($path, '/'));
    }

    protected function routesPath(): string
    {
        return App::isLaravel()
            ? $this->fullPath('routes/laravel.php')
            : $this->fullPath('routes/lumen.php');
    }
}
