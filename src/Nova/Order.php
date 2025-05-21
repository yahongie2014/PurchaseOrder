<?php

namespace PurchaseOrder\Nova;

use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Http\Requests\NovaRequest;

use PurchaseOrder\Nova\Filters\PaymentStatusFilter;
use PurchaseOrder\Nova\Actions\MarkAsPaid;
use PurchaseOrder\Nova\Metrics\OrdersPerDay;
use PurchaseOrder\Nova\Metrics\PaymentStatusPartition;
use Illuminate\Http\Request;

class Order extends Resource
{
    public static $model = \PurchaseOrder\Models\Order::class;

    public static $title = 'order_number';

    public static $search = ['id', 'order_number', 'invoice_number', 'payment_status'];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Order Number')->sortable()->rules('required', 'max:255'),

            BelongsTo::make('User')->nullable(),

            BelongsTo::make('Cashier')->nullable(),

            BelongsTo::make('Customer')->nullable(),

            Number::make('Subtotal')->step(0.01),

            Number::make('Discount Amount')->step(0.01),

            Number::make('Tax Amount')->step(0.01),

            Number::make('Total Amount')->step(0.01),

            Number::make('Paid Amount')->step(0.01),

            Text::make('Payment Status')->sortable(),

            Text::make('Source')->nullable(),

            Text::make('Invoice Number')->nullable(),

            Text::make('Notes')->hideFromIndex()->nullable(),

            DateTime::make('Created At')->sortable(),

            DateTime::make('Updated At')->sortable(),

            HasMany::make('Items', 'items', OrderItem::class),

            HasMany::make('Payments', 'payments', Payment::class),
        ];
    }

    public function filters(Request $request)
    {
        return [
            new PaymentStatusFilter(),
        ];
    }

    public function actions(Request $request)
    {
        return [
            new MarkAsPaid(),
        ];
    }

    public function cards(Request $request)
    {
        return [
            new OrdersPerDay(),
            new PaymentStatusPartition(),
        ];
    }
}
