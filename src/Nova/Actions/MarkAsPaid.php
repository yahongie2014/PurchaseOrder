<?php

namespace PurchaseOrder\Nova\Actions;

use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Support\Collection;

class MarkAsPaid extends Action
{
    public $name = 'Mark As Paid';

    public function handle(ActionFields $fields, Collection $models)
    {
        foreach ($models as $order) {
            $order->update(['payment_status' => 'paid']);
        }

        return Action::message('Selected orders marked as paid.');
    }

    public function fields()
    {
        return [];
    }
}
