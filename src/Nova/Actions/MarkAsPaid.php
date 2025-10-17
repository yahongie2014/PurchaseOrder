<?php

namespace App\Nova\PurchaseOrder\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;

class MarkAsPaid extends Action
{
    use InteractsWithQueue;
    use Queueable;

    public $name = 'Mark As Paid';

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */

    public function handle(ActionFields $fields, Collection $models)
    {
        foreach ($models as $order) {
            $order->update(['payment_status' => 'paid']);
            $order->saveQuietly();
        }

        return Action::message('Selected orders marked as paid.');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array<int, \Laravel\Nova\Fields\Field>
     */
    public function fields(NovaRequest $request): array
    {
        return [];
    }
}
