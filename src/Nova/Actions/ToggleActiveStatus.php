<?php

namespace PurchaseOrder\Nova\Actions;

use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Support\Collection;

class ToggleActiveStatus extends Action
{
    public $name = 'Toggle Active Status';

    public function handle(ActionFields $fields, Collection $models)
    {
        foreach ($models as $model) {
            $model->update(['is_active' => !$model->is_active]);
        }

        return Action::message('Active status toggled successfully.');
    }

    public function fields()
    {
        return [];
    }
}
