<?php

namespace App\Nova\PurchaseOrder;

use App\Nova\PurchaseOrder\Actions\MarkAsPaid;
use App\Nova\PurchaseOrder\Actions\MarkAsPartial;
use App\Nova\PurchaseOrder\Actions\MarkAsPending;
use App\Nova\PurchaseOrder\Filters\PaymentStatusFilter;
use App\Nova\PurchaseOrder\Metrics\OrdersPerDay;
use App\Nova\PurchaseOrder\Metrics\PaymentStatusPartition;
use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Http\Request;
use App\Models\PurchaseOrder\Order as OrderModel;

class Order extends Resource
{
    public static $model = OrderModel::class;

    public static $title = 'order_number';

    public static $search = ['id', 'order_number', 'invoice_number', 'payment_status'];


    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('Order Number')->sortable()->rules('required', 'max:255'),
            BelongsTo::make('User')->nullable(),
            BelongsTo::make('Cashier', 'cashier', Cashier::class)->nullable(),
            Number::make('Subtotal')->step(0.01),
            Number::make('Discount Amount')->step(0.01)->hideFromIndex(),
            Number::make('Tax Amount')->step(0.01)->hideFromIndex(),
            Number::make('Total Amount')->step(0.01),
            Number::make('Paid Amount')->step(0.01),
            Text::make('Payment Status')->sortable(),
            Text::make('Source')->nullable(),
            Text::make('Invoice Number')->nullable(),
            Text::make('Notes')->hideFromIndex()->nullable()->hideFromIndex(),
            DateTime::make('Created At')->sortable(),
            DateTime::make('Updated At')->sortable()->hideFromIndex(),
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
            new MarkAsPending(),
            new MarkAsPartial(),
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
