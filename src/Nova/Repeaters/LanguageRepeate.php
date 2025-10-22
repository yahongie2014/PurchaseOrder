<?php

namespace App\Nova\Repeaters;

use Laravel\Nova\Fields\Repeater\Repeatable;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;

class LanguageRepeate extends Repeatable
{
    /**
     * Get the fields displayed by the repeatable.
     *
     * @return array<int, \Laravel\Nova\Fields\Field>
     */
    public function fields(NovaRequest $request): array
    {
        $locales = config('locales.locales', ['en' => 'English', 'ar' => 'Arabic']);
        return [
            Select::make('Locale')
                ->options($locales)
                ->rules('required', 'max:10')
                ->displayUsingLabels(),
            Text::make('Name')
                ->creationRules('required', 'max:255')
                ->updateRules('required', 'max:255'),
            Trix::make('Description')
                ->creationRules('required', 'max:500')
                ->updateRules('required', 'max:500')
                ->hideFromIndex(),
        ];
    }

    /**
     * Get the default value for the repeatable.
     *
     * @return array
     */
    public function defaultValue(): array
    {
        return [
            ['locale' => 'en', 'name' => '', 'description' => ''],
            ['locale' => 'ar', 'name' => '', 'description' => ''],
        ];
    }

    /**
     * Get the maximum number of rows.
     *
     * @return int
     */
    public function maxRows(): int
    {
        return 2;
    }

    /**
     * Get the minimum number of rows.
     *
     * @return int
     */
    public function minRows(): int
    {
        return 2;
    }
}
