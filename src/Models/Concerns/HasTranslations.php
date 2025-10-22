<?php

namespace App\Models\PurchaseOrder\Concerns;

use Illuminate\Support\Arr;

trait HasTranslations
{
    protected string $translationAttribute = 'translations';

    public function t(string $key, ?string $locale = null, bool $useFallback = true, $default = null)
    {
        $translations = (array) ($this->{$this->translationAttribute} ?? []);
        $locale = $locale ?: app()->getLocale();

        if (isset($translations[$locale])) {
            $val = Arr::get($translations[$locale], $key);
            if (!is_null($val)) return $val;
        }

        if ($useFallback) {
            $current = app()->getLocale();
            if ($current !== $locale && isset($translations[$current])) {
                $val = Arr::get($translations[$current], $key);
                if (!is_null($val)) return $val;
            }
            $fallback = config('app.fallback_locale');
            if ($fallback && $fallback !== $locale && $fallback !== $current && isset($translations[$fallback])) {
                $val = Arr::get($translations[$fallback], $key);
                if (!is_null($val)) return $val;
            }
            foreach ($translations as $loc => $data) {
                $val = Arr::get($data, $key);
                if (!is_null($val)) return $val;
            }
        }
        return $default;
    }

    public function setTranslation(string $key, $value, ?string $locale = null): static
    {
        $locale = $locale ?: app()->getLocale();
        $all = (array) ($this->{$this->translationAttribute} ?? []);
        $all[$locale] = (array) ($all[$locale] ?? []);
        Arr::set($all[$locale], $key, $value);
        $this->{$this->translationAttribute} = $all;
        return $this;
    }

    public function mergeTranslations(array $data, ?string $locale = null): static
    {
        $locale = $locale ?: app()->getLocale();
        $all = (array) ($this->{$this->translationAttribute} ?? []);
        $langBlock = (array) ($all[$locale] ?? []);
        $all[$locale] = array_replace_recursive($langBlock, $data);
        $this->{$this->translationAttribute} = $all;
        return $this;
    }

    public function availableLocales(): array
    {
        return array_keys((array) ($this->{$this->translationAttribute} ?? []));
    }
}
