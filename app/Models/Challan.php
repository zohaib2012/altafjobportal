<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Challan extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'challan_no', 'application_id', 'fee_amount', 'bank_charges', 'total_amount',
        'generated_at', 'is_fee_verified', 'fee_verified_at', 'fee_verified_by'
    ];

    protected function casts(): array
    {
        return [
            'fee_amount' => 'decimal:2',
            'bank_charges' => 'decimal:2',
            'total_amount' => 'decimal:2',
            'generated_at' => 'datetime',
        ];
    }

    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }
}