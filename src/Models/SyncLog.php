<?php

namespace App\Models\PurchaseOrder;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SyncLog extends Model
{
    use HasFactory;

    protected $table = 'sync_logs';

    protected $fillable = [
        'entity_type', 'entity_id', 'status', 'synced_at', 'response_data'
    ];

    protected $casts = [
        'synced_at' => 'datetime',
        'response_data' => 'array',
    ];

    protected static function newFactory()
    {
        return \Database\Factories\SyncLogFactory::new();
    }

}
