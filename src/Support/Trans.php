<?php

namespace PrettyRoutes\Support;

use Helldar\Support\Facades\Arr;
use Illuminate\Support\Facades\App;

final class Trans
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
        $locale = $this->isForce() ? $this->getForceLocale() : $this->appLocale();

        $exploded = explode(',', $locale);

        return $this->getCorrectedLocale(
            reset($exploded),
            $this->appLocale()
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
