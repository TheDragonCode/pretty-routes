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

namespace PrettyRoutes\Support;

use DragonCode\Support\Facades\Helpers\Arr;
use Illuminate\Support\Facades\App;

class Trans
{
    public const DEFAULT_LOCALE = 'en';

    protected static $translations = [];

    public function get(string $key): string
    {
        return Arr::get($this->all(), $key);
    }

    public function all(): array
    {
        $locale = $this->getLocale();

        if (! isset(static::$translations[$locale])) {
            static::$translations[$locale] = require $this->path($locale);
        }

        return static::$translations[$locale];
    }

    protected function isForce(): bool
    {
        return ! empty($this->getForceLocale());
    }

    protected function appLocale(): string
    {
        return App::getLocale();
    }

    protected function getLocale(): string
    {
        $current = explode(',', $this->isForce() ? $this->getForceLocale() : $this->appLocale());
        $app     = explode(',', $this->appLocale());

        return $this->getCorrectedLocale(
            reset($current),
            reset($app)
        );
    }

    protected function getCorrectedLocale(string $locale, string $default): string
    {
        if ($this->exist($locale)) {
            return $locale;
        }

        return $this->exist($default) ? $default : self::DEFAULT_LOCALE;
    }

    protected function getForceLocale()
    {
        return config('pretty-routes.locale_force');
    }

    protected function exist(string $locale): bool
    {
        return ! empty($this->path($locale));
    }

    protected function path(string $locale): string
    {
        return realpath(__DIR__ . '/../../resources/lang/' . $locale . '/info.php');
    }
}
