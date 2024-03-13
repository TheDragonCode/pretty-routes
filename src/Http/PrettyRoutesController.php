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

namespace PrettyRoutes\Http;

use DragonCode\LaravelRoutesCore\Support\Routes;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use PrettyRoutes\Facades\Cache;
use PrettyRoutes\Support\Config;

class PrettyRoutesController extends BaseController
{
    /**
     * Getting a template for routes.
     */
    public function show(): View
    {
        return view('pretty-routes::layout');
    }

    /**
     * Getting a list of routes.
     */
    public function routes(Routes $routes, Config $config): JsonResponse
    {
        $routes->setFromConfig($config);

        return response()->json(
            $routes->get()
        );
    }

    /**
     * Clearing cached routes.
     */
    public function clear(): JsonResponse
    {
        return Cache::when($this->allow())->routeClear()
            ? response()->json('ok')
            : response()->json('disabled', 400);
    }

    protected function allow(): bool
    {
        return config('app.env') !== 'production' && (bool) config('app.debug') === true;
    }
}
