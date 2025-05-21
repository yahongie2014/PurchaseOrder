<?php

namespace PurchaseOrder\Models;

use Illuminate\Database\Eloquent\Model;

class SyncLog extends Model
{
    protected $table = 'sync_logs';
    protected $fillable = [
        'entity_type', 'entity_id', 'status', 'synced_at', 'response_data'
    ];

}