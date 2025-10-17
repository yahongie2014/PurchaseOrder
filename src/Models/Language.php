<?php

namespace App\Models\PurchaseOrder;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'languages';

    protected $fillable = [
        'code',
        'name',
        'direction',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function isRtl()
    {
        return $this->direction === 'rtl';
    }

    public function isActive()
    {
        return $this->is_active;
    }
}
