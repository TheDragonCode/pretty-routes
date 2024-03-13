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

namespace Tests;

use Illuminate\Support\Facades\Config;
use Orchestra\Testbench\TestCase as BaseTestCase;
use PrettyRoutes\ServiceProvider;

abstract class TestCase extends BaseTestCase
{
    protected function getEnvironmentSetUp($app)
    {
        $this->setConfig($app);
        $this->setRoutes($app);
    }

    protected function getPackageProviders($app): array
    {
        return [ServiceProvider::class];
    }

    protected function setRoutes($app)
    {
        $app['router']->get('/foo', function () {});

        $app['router']->match(['PUT', 'PATCH'], '/bar', function () {});

        $app['router']->get('/_ignition/baq', function () {});

        $app['router']->get('/telescope/baw', function () {});

        $app['router']->get('/_debugbar/bae', function () {});
    }

    protected function setConfig($app)
    {
        $app['config']->set('pretty-routes.hide_methods', ['HEAD', 'GET']);
        $app['config']->set('pretty-routes.debug_only', false);
    }

    protected function setConfigLocale(string $for_app, ?string $for_package = null): void
    {
        Config::set('app.locale', $for_app);
        Config::set('pretty-routes.locale_force', $for_package ?: false);
    }
}
