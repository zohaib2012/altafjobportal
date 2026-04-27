<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
    protected $fillable = [
        'application_id', 'cv_path', 'cv_original_name', 'cv_size', 'cv_uploaded_at',
        'challan_path', 'challan_original_name', 'challan_size', 'challan_uploaded_at'
    ];

    protected function casts(): array
    {
        return [
            'cv_uploaded_at' => 'datetime',
            'challan_uploaded_at' => 'datetime',
        ];
    }

    public function application(): BelongsTo
    {
        return $this->belongsTo(Application::class);
    }
}